require('./bootstrap');

NProgress = require('nprogress')

$(document).ready(function () {

    NProgress.set(0.2);
    NProgress.start();

    setTimeout(() => {
        NProgress.done();
    }, 500);

    $('a').on('click', function(){
        const target = $(this).prop('target');

        console.log(this.href)

        if(this.href.indexOf('#') === -1 && target !== '_blank' && this.href !== 'javascript:void(0)')
            NProgress.start();

    });

    $('form').on('submit', function(){
        NProgress.start();

        $(this).find(`button[type="submit"]`).attr("disabled", true)
    })
})
