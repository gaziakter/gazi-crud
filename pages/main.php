<?php

/** Main content function */
global $wpdb;

// Retrieve data from the database
$data = $wpdb->get_results("SELECT * FROM {$this->table_name}");

// Display the data in a table
?>
<div class="wrapper p-20">
    <div class="gazi-header">
        <h2 class="text-4xl py-4 font-extrabold dark:text-white">Gazi Crud - All Data</h2>
        <hr class="mb-10">
    </div>
    <div class="relative shadow-md sm:rounded-lg">
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
                if ($data) {
                    foreach ($data as $row) {
                ?>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4"><?php echo $row->id; ?></td>
                            <td class="px-6 py-4"><?php echo $row->name; ?></td>
                            <td class="px-6 py-4"><?php echo $row->email; ?></td>
                            <td class="px-6 py-4">
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=gazi-edit-data&id=' . $row->id ) ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> |
                                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=gazi-edit-data&id=' . $row->id ) ); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4">No data found.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>