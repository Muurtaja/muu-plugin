<div class="wrap">
    <h1>Muu Plugin</h1>
    <?php settings_errors() ?>

    <form method="post" action="options.php">
        <?php
        settings_fields('muu_options_group');
        do_settings_sections('muu_plugin');
        submit_button();
        ?>

    </form>
</div>