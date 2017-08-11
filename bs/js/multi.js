(function( $ ){

    $.fn.multipleInput = function() {

        return this.each(function() {
            $list = $('<ul />');
            // input
            var $input = $('<input type="text" name="email[]" />').keyup(function(event) {

                if(event.which == 32 || event.which == 188) {
                    // key press is space or comma
                    var val = $(this).val().slice(0, -1); // remove space/comma from value
                    var pattern=/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/;
                   if(val!=null ||val!=""){
                    if(pattern.test(val)==false){
                      bootbox.alert('<div class="alert alert-error">Enter valid email address</div>');
                      $(".btn").attr('disabled', 'disabled');
                      return false;
                    }
                   }
                    // append to list of emails with remove button
                    $list.append($('<li class="multipleInput-email"><span>' + val + '</span></li>')
                        .append($('<a href="#" class="multipleInput-close" title="Remove"/>')
                            .click(function(e) {
                                $(this).parent().remove();
                                e.preventDefault();
                            })
                            )
                        );
                    $(this).attr('placeholder', '');
                    // empty input
                    $(this).val('');
                }
               $(".btn").removeAttr('disabled');
            });

            // container div
            var $container = $('<div class="multipleInput-container" />').click(function() {
                $input.focus();
            });

            // insert elements into DOM
            $container.append($list).append($input).insertAfter($(this));
            return $(this).hide();

        });

    };
})( jQuery );