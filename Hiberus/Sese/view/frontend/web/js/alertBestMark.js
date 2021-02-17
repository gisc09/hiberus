require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };
        var popup = modal(options, $('#popup-modal'));
        $(".best-mark").on('click',function(){
            $("#popup-modal").modal("openModal");
        });

    }
);