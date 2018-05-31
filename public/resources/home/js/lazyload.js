(function ($) {
    var defaluts={
        d:500,
        r:550
    };
    function setshow(obj,r) {
        var t=$(window).scrollTop();
        if(t<obj.offset().top+obj.outerHeight()+r&&t>obj.offset().top-$(window).height()-r){
            return true;
        }else{
            return false;
        }
    }
    function setimg(obj,r) {
        if(obj.attr('data-true-img')){
            return ''
        }
        if(setshow(obj,r)&&obj.attr('data-original')){
            $('body').attr('data-imgnum',parseInt($('body').attr('data-imgnum'))+1);
            obj.attr('src',obj.attr('data-original'));
            obj.attr('data-true-img',true);
        }
    }
    
    function setbg(obj,r) {
        if(obj.attr('data-true-bg')){
            return ''
        }
        if(setshow(obj,r)&&obj.attr('data-bg')){
            $('body').attr('data-bgnum',parseInt($('body').attr('data-bgnum'))+1);
            obj.css('background-image','url('+obj.attr('data-bg')+')');
            obj.attr('data-true-bg',true);
        }
    }

    $.fn.lazyimg=function (options) {
        var options=$.extend(defaluts,options);
        var win=$(window);
        var yesno=true;
        var _that=this;
        var length=_that.length;
        $('body').attr('data-imgnum',0);
        _that.each(function () {
            setimg($(this),options.r);
            return '';
        });
        win.scroll(function () {
            if(yesno){
                yesno=false;
                setTimeout(function () {
                    _that.each(function () {
                        setimg($(this),options.r);
                        return '';
                    });
                    if($('body').attr('data-imgnum')==length){
                        yesno=false;
                    }else{
                        yesno=true;
                    }
                },options.d);
            }
        })
    };
    
     $.fn.lazybg=function (options) {
        var options=$.extend(defaluts,options);
        var win=$(window);
        var yesno=true;
        var _that=this;
        var length=_that.length;
        $('body').attr('data-bgnum',0);
        _that.each(function () {
            setbg($(this),options.r);
            return '';
        });
        win.scroll(function () {
            if(yesno){
                yesno=false;
                setTimeout(function () {
                    _that.each(function () {
                        setbg($(this),options.r);
                        return '';
                    });
                    if($('body').attr('data-bgnum')==length){
                        yesno=false;
                    }else{
                        yesno=true;
                    }
                },options.d);
            }
        })
    };
})(jQuery);