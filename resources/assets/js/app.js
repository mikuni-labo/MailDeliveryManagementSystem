
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});


/**
 * Logout
 */
(function (){
    var logoutBtn = document.getElementById('logoutBtn');

    if(logoutBtn) {
        logoutBtn.onclick = function (e) {
            e.preventDefault();

            if( confirm('ログアウトしますか？') ) {
                document.getElementById('logout-form').submit();
            }
        }
    }
})();

/**
 * Delete a record.
 */
(function (){
    var deleteBtn = document.getElementById('deleteBtn');

    if(deleteBtn) {
    	    deleteBtn.onclick = function (e) {
    	        e.preventDefault();

            if( confirm('本当に削除しますか？') ) {
                var form = document.getElementById('delete-form');
                form.action = deleteBtn.href;
                form.submit();
            }
        }
    }
})();

/**
 * Restore a record.
 */
(function (){
    var restoreBtn = document.getElementById('restoreBtn');

    if(restoreBtn) {
    	    restoreBtn.onclick = function (e) {
    	        e.preventDefault();

            if( confirm('本当に復旧しますか？') ) {
                var form = document.getElementById('restore-form');
                form.action = restoreBtn.href;
                form.submit();
            }
        }
    }
})();

/**
 * Bootstrap Tooltip
 */
(function (){
    $('[data-toggle="tooltip"]')
    .tooltip({
        html: true,
        container: 'body'
    })
    .on("show.bs.tooltip", function() {
        setTimeout(function () {
            $(".tooltip").fadeOut('fast', function() {
                $(this).remove();
            });
        }, 8000);
    })
    $("[data-toggle=tooltip]").tooltip();
})();
