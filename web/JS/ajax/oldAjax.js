$(function(){
    init_get();
    init_post();
});

function init_get()
{
    $(document).one('click', 'a.ajaxArticleBodyByGet',function(event){
        event.preventDefault();
        let contentId = $(this).attr('data-contentId');
        let link = $(this).attr('href');
        $.ajax({
            url:'/index.php?route=ajax/get&id=' + contentId,
            dataType: 'json'
        })
            .done (function(obj){
                $('p.summary' + contentId).text(obj);
            })
            .fail(function(xhr, status, error){
                console.log('ajaxError xhr:', xhr); // выводим значения переменных
                console.log('ajaxError status:', status);
                console.log('ajaxError error:', error);

                console.log('Ошибка соединения при получении данных (GET)');
            });

        return false;

    });
}

function init_post()
{
    $('a.ajaxArticleBodyByPost').one('click', function(event){
        event.preventDefault();
        let content = $(this).attr('data-contentId');
        $.ajax({
            url:'/index.php?route=ajax/post',
            data: 'id='+content,
            dataType: 'text',
            converters: 'json text',
            method: 'POST'
        })
            .done (function(obj){
                $('p.summary' + content).text(JSON.parse(obj));
            })
            .fail(function(xhr, status, error){
                console.log('Ошибка соединения с сервером (POST)');
                console.log('ajaxError xhr:', xhr); // выводим значения переменных
                console.log('ajaxError status:', status);
                console.log('ajaxError error:', error);
            });

        return false;

    });
}

