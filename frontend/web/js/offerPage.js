
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var offerPage = {

    init: function () {

        var _this = this;
        //_this.createForm(_this);

    },

    createForm: function () {

        $(function () {
            $('.buttonOfferBuy').click(function () {

                $('#modal').modal("show")
                        .find('.contentModal')
                        .load($(this).attr('value'));
            });
        });


    }

}
offerPage.init();