jQuery(document).on('ready', function () {
    jQuery(document).on('click', '#elementor-panel-saver-button-publish', function () {
        $e.internal('document/save/save', {
            force: true,
            onSuccess: function () {
                $e.run('document/save/publish', {
                    force: true,
                });
                setTimeout(() => {
                    jQuery.ajax({
                        type: "get",
                        url: CurrentPageURL,
                    });
                }, 1000);
            }
        });
    });
})