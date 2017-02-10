$(function(){

    // �R�����g���M���t���O
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

    // ���M����
    $('#form-comment').submit(function()
    {
        // �ʏ��POST���L�����Z��
        event.preventDefault();
        // �ʐM����Ajax��j��

        // �ŐV�̃R�����g�擾�ʒu��ݒ�
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
                //JSON���p�[�X
                var res = JSON.parse(result);
                if (res['result'] === 'success') {
                    // �G���[���b�Z�[�W���N���A
                    $('#error_area').html('');
                    // �ŐV�̃R�����g��\��
                    $(res['html']).css('display', 'none').prependTo($('#timeline')).animate({height: 'show', opacity: 'show'}, 'normal');
                    // �g�[�N���X�V
                    $('#form-comment').find('[name=_token]').val(res['_token']);
                }
                else {
                    // �G���[���b�Z�[�W���N���A
                    $('#error_area').html('');
                    // �G���[���b�Z�[�W��\��
                    $(res['html']).css('display', 'none').prependTo($('#error_area')).animate({opacity: 'show'}, 'normal');
                    // �g�[�N���X�V
                    $('#form-comment').find('[name=_token]').val(res['_token']);
                }
            },
            error: function(xhr, textStatus, error)
            {
                ;
            }
        });
    });

    // �ŐV�̃R�����g���擾���ă��X�g�ɔ��f
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

    // �Â��R�����g���擾���ă��X�g�ɔ��f
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

    // �ŐV�R�����g�擾�J�nID�擾
    function getNewCommentID()
    {
        var arrayComment = [];
        $('[name="comment[]"]').each(function(i) {
            arrayComment.push($('[name="comment[]"]').eq(i).data('id'));
        });

        // �R�����gID�̍ő�l�̎���ID
        return Math.max.apply(null, arrayComment);
    }

    // �ŌÃR�����g�擾�J�nID�擾
    function getOldCommentID()
    {
        var arrayComment = [];
        $('[name="comment[]"]').each(function(i) {
            arrayComment.push($('[name="comment[]"]').eq(i).data('id'));
        });

        // �R�����gID�̍ő�l�̎���ID
        return Math.min.apply(null, arrayComment);
    }

/*
    // ���������[�h
    setInterval(function()
    {
        // �R�����g���M���̏ꍇ�̓����[�h���Ȃ�
        getNewCommnet();
    },3000);
*/
});

