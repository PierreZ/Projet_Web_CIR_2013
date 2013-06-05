<script type="text/javascript">


function();

$(function() {
    alert('Ici, c\'est votre message!\nSympa non ?');
    var menu_ul = $('.resume > li > ul'),
        menu_a  = $('.resume > li > a');
    menu_ul.hide();
    menu_a.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            menu_a.removeClass('active');
            menu_ul.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });
});
</script>