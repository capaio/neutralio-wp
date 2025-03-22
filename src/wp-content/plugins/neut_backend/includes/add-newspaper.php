<?php

function add_newspaper() {
    global $wpdb; // Use the WordPress database global object

    // Handle form submission for adding or editing newspapers
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize inputs
        $name = sanitize_text_field($_POST['textfield']);
        $image_id = isset($_POST['image_id']) ? intval($_POST['image_id']) : 0;
        $image_url = wp_get_attachment_url($image_id);

        // Check if editing or inserting a new entry
        if (isset($_POST['newspaper_id']) && $_POST['newspaper_id'] !== '') {
            // Update existing entry
            $table_name = $wpdb->prefix . 'newspapers';
            $newspaper_id = intval($_POST['newspaper_id']);

            // Retrieve the existing logo if no new image is uploaded
            if ($image_id === 0) {
                $existing_newspaper = $wpdb->get_row("SELECT logo FROM {$table_name} WHERE id = $newspaper_id");
                $image_url = $existing_newspaper->logo; // Retain the existing logo
            }

            $updated = $wpdb->update(
                $table_name,
                array(
                    'name' => $name,
                    'logo' => $image_url
                ),
                array('id' => $newspaper_id)
            );

            // Check if the update was successful
            if ($updated !== false) {
                echo '<div class="updated"><p>Newspaper updated successfully!</p></div>';
            } else {
                echo '<div class="error"><p>Failed to update newspaper. Error: ' . esc_html($wpdb->last_error) . '</p></div>';
            }
        } else {
            // Insert new entry
            $table_name = $wpdb->prefix . 'newspapers';
            $inserted = $wpdb->insert(
                $table_name,
                array(
                    'name' => $name,
                    'logo' => $image_url
                )
            );

            // Check if the insert was successful
            if ($inserted) {
                echo '<div class="updated"><p>Newspaper added successfully!</p></div>';
            } else {
                echo '<div class="error"><p>Failed to add newspaper. Error: ' . esc_html($wpdb->last_error) . '</p></div>';
            }
        }
    }

    // Retrieve existing newspapers
    $existing_newspapers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}newspapers");

    ?>
    <div class="wrap">
        <h1>Manage Newspapers</h1>
        <button type="button" id="open-modal" class="button">Add New Newspaper</button>

        <h2>Existing Newspapers</h2>
        <?php if ($existing_newspapers): ?>
            <table class="widefat">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($existing_newspapers as $newspaper): ?>
                        <tr>
                            <td><?php echo esc_html($newspaper->name); ?></td>
                            <td><img src="<?php echo esc_url($newspaper->logo); ?>" style="max-width: 20px;"/></td>
                            <td>
                                <button class="edit-button"
                                        data-id="<?php echo esc_attr($newspaper->id); ?>"
                                        data-name="<?php echo esc_attr($newspaper->name); ?>"
                                        data-logo="<?php echo esc_url($newspaper->logo); ?>">Edit</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No newspapers found.</p>
        <?php endif; ?>
    </div>

    <!-- Modal for adding and editing newspapers -->
    <div id="newspaper-modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; z-index:1000;">
        <form method="post" id="image-form-modal">
            <input type="hidden" name="newspaper_id" id="newspaper_id">
            <label for="image_id">Logo:</label>
            <input type="hidden" name="image_id" id="image_id">
            <div id="image-preview" style="margin-bottom: 10px;"></div>
            <button type="button" id="upload-image-button-modal" class="button">Upload Image</button>
            <br><br>
            <label for="textfield">Nome:</label>
            <input type="text" name="textfield" id="textfield" required>
            <br><br>
            <input type="submit" value="Submit">
            <button type="button" id="close-modal" class="button">Close</button>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var image_frame;

        // Open the modal for adding a new newspaper
        $('#open-modal').on('click', function() {
            $('#newspaper_id').val(''); // Clear the id field for new entry
            $('#textfield').val(''); // Clear the name field
            $('#image_id').val(''); // Clear the image field
            $('#image-preview').html(''); // Clear image preview
            $('#newspaper-modal').show(); // Show modal
        });

        // Edit button functionality
        $('.edit-button').on('click', function() {
            var newspaperId = $(this).data('id');
            var newspaperName = $(this).data('name');
            var newspaperLogo = $(this).data('logo');

            $('#newspaper_id').val(newspaperId); // Set the id for the entry being edited
            $('#textfield').val(newspaperName); // Set the name field
            $('#image_id').val(newspaperLogo); // Set the image field
            $('#image-preview').html('<img src="' + newspaperLogo + '" style="max-width: 200px;"/>'); // Show image preview
            $('#newspaper-modal').show(); // Show modal
        });

        // Media uploader for the modal
        $('#upload-image-button-modal').on('click', function(event) {
            event.preventDefault();
            if (image_frame) {
                image_frame.open();
                return;
            }
            image_frame = wp.media({
                title: 'Select an Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            image_frame.on('select', function() {
                var attachment = image_frame.state().get('selection').first().toJSON();
                $('#image_id').val(attachment.id);
                $('#image-preview').html('<img src="' + attachment.url + '" style="max-width: 200px;"/>');
            });
            image_frame.open();
        });

        // Close modal functionality
        $('#close-modal').on('click', function() {
            $('#newspaper-modal').hide(); // Hide modal
        });
    });
    </script>
    <?php
}
