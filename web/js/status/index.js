$(function(){

    // コメント送信中フラグ
    var flgPageLoading = false;

    $('#method-reload').on('click', function()
    {
        getOldCommnet();
    });

    $(window).bind("scroll", function()
    {
        scrollHeight = $(document).height();
        scrollPosition = $(window).height() + $(window).scrollTop();
        if (flgPageLoading === false) {
            if ((scrollHeight - scrollPosition) / scrollHeight <= 0.05) {
                getOldCommnet();
            }
        }
    });

    // 送信処理
    $('#form-comment').submit(function()
    {
        // 通常のPOSTをキャンセル
        event.preventDefault();
        // 通信中のAjaxを破棄

        // 最新のコメント取得位置を設定
        $(this).find('[name=offset]').val(getNewCommentID());

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            timeout: 10000,

            beforeSend: function(xhr, settings)
            {
            },
            complete: function(xhr, textStatus)
            {
            },
            success: function(result, textStatus, xhr)
            {
                //JSONをパース
                var res = JSON.parse(result);
                if (res['result'] === 'success') {
                    // エラーメッセージをクリア
                    $('#error_area').html('');
                    // 最新のコメントを表示
                    $(res['html']).css('display', 'none').prependTo($('#timeline')).animate({height: 'show', opacity: 'show'}, 'normal');
                    // トークン更新
                    $('#form-comment').find('[name=_token]').val(res['_token']);
                }
                else {
                    // エラーメッセージをクリア
                    $('#error_area').html('');
                    // エラーメッセージを表示
                    $(res['html']).css('display', 'none').prependTo($('#error_area')).animate({opacity: 'show'}, 'normal');
                    // トークン更新
                    $('#form-comment').find('[name=_token]').val(res['_token']);
                }
            },
            error: function(xhr, textStatus, error)
            {
                ;
            }
        });
    });

    // 最新のコメントを取得してリストに反映
    function getNewCommnet()
    {
        var offset = getNewCommentID();

        $.ajax({
            type: 'GET',
            url: BASE_URL + '/status/offset/' + offset,
            dataType: 'html',
            
            success: function(result, textStatus, xhr)
            {
                $(result).css('display', 'none').prependTo($('#timeline')).animate({height: 'show', opacity: 'show'}, 'normal');
            }
        });
    }

    // 古いコメントを取得してリストに反映
    function getOldCommnet()
    {
        var offset = getOldCommentID();
        flgPageLoading = true;

console.log(offset);

        $.ajax({
            type: 'GET',
            url: BASE_URL + '/status/page/' + offset,
            dataType: 'html',
            
            success: function(result, textStatus, xhr)
            {
                $(result).css('display', 'none').appendTo($('#timeline')).animate({height: 'show', opacity: 'show'}, 'normal');
                flgPageLoading = false;
            }
        });
    }

    // 最新コメント取得開始ID取得
    function getNewCommentID()
    {
        var arrayComment = [];
        $('[name="comment[]"]').each(function(i) {
            arrayComment.push($('[name="comment[]"]').eq(i).data('id'));
        });

        // コメントIDの最大値の次のID
        return Math.max.apply(null, arrayComment);
    }

    // 最古コメント取得開始ID取得
    function getOldCommentID()
    {
        var arrayComment = [];
        $('[name="comment[]"]').each(function(i) {
            arrayComment.push($('[name="comment[]"]').eq(i).data('id'));
        });

        // コメントIDの最大値の次のID
        return Math.min.apply(null, arrayComment);
    }

/*
    // 自動リロード
    setInterval(function()
    {
        // コメント送信中の場合はリロードしない
        getNewCommnet();
    },3000);
*/
});

