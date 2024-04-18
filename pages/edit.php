<?php
global $wpdb;

// Retrieve the ID of the data to be edited
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Retrieve the existing data from the database
$data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $id));

if (!$data) {
    echo 'Data not found.';
    return;
}

?>
<div class="wrapper p-20">
    <div class="gazi-header">
        <h2 class="text-4xl py-4 font-extrabold dark:text-white">Gazi Crud - Edit Data</h2>
        <hr class="mb-10">
    </div>
    <form class="max-w-sm" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <?php wp_nonce_field('gazi_edit_data', 'gazi_edit_data_nonce'); ?>
        <input type="hidden" name="action" value="gazi_edit_data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="GM. Akter" value="<?php echo esc_attr($data->name); ?>" required />
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" value="<?php echo esc_attr($data->email); ?>" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </form>
</div>