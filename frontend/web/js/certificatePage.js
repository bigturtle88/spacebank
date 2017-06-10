/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



var certificatePage = {

    init: function () {
        
        var _this = this;
        _this.createCollapse(_this);
        
    },
    
    createCollapse: function () {
        
       $('.collapse').collapse('toggle');
       $('.panel-collapse').collapse('toggle');

    }

}
certificatePage.init();