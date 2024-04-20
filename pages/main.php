<?php

/** Main content function */
global $wpdb;

        // Check if delete action is triggered
        if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' ) {
            // Check if ID is provided
            if ( isset( $_GET['id'] ) ) {
                $id = intval( $_GET['id'] );
                // Delete the entry from the database
                $wpdb->delete( $this->table_name, [ 'id' => $id ] );
                // Redirect back to the main content page
                //wp_redirect( admin_url( 'admin.php?page=gazi-crud' ) );
                //exit;
            }
        }

// Retrieve data from the database
$data = $wpdb->get_results("SELECT * FROM {$this->table_name}");

$dispay_alert = 'Are you sure you want to delete this item?';

// Display the data in a table
?>
<div class="wrapper p-20">
    <div class="gazi-header">
        <h2 class="text-4xl py-4 font-extrabold dark:text-white">Gazi Crud - All Data</h2>
        <hr class="mb-10">
    </div>
    <?php  if ($data) { ?>
    <div class="relative shadow-md sm:rounded-lg">
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=gazi-add-new-data') ); ?>" class="mb-5 inline-block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add New Data</a>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    foreach ($data as $row) {
                ?>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4"><?php echo $row->id; ?></td>
                            <td class="px-6 py-4"><?php echo $row->name; ?></td>
                            <td class="px-6 py-4"><?php echo $row->email; ?></td>
                            <td class="px-6 py-4">
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=gazi-edit-data&id=' . $row->id ) ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=gazi-crud&action=delete&id=' . $row->id ) ); ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('<?php echo esc_js( $dispay_alert ); ?>');">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
 
                ?>
            </tbody>
        </table>
    </div>
    <?php                } else {
                    ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4"><h2>No data found.</h2></td>
                    </tr>
                <?php
                } ?>
</div>