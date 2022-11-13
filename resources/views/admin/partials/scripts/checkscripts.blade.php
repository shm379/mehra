<script type="text/javascript">
    // avoid from confiicting jquery
    $(document).ready(function () {
        $('#options').click(function () {
            if (this.checked) {
                $('.checkBox').each(function () {
                    this.checked = true;
                })
            } else {
                $('.checkBox').each(function () {
                    this.checked = false;
                })
            }
        })
    });

    function chk_selection() {
        var checked = false;
        var element = document.getElementsByName("checkBoxArray[]");

        for (var i = 0; i < element.length; i++) {
            if (element[i].checked)
                checked = true;
        }
        if (!checked) {
            checked = false
        }
        return checked;

    }

    // when user clicks on each button here comands change -> we change route for commands
    function submitForm(command, action) {

        if (this.chk_selection()) {
            var form = document.getElementById('frm_delete');
            form.action = action;

            if (command == 'pub') {

                $("<input />").attr("type", "hidden")
                    .attr("name", "command")
                    .attr("value", command)
                    .appendTo("#frm_delete");
                // form.method = 'GET';
            } else if (command == 'unPub') {
                $("<input />").attr("type", "hidden")
                    .attr("name", "command")
                    .attr("value", command)
                    .appendTo("#frm_delete");
                // form.method = 'GET';
            }
            else if (command == 'delete') {
                $("<input />").attr("type", "hidden")
                    .attr("name", "command")
                    .attr("value", command)
                    .appendTo("#frm_delete");
                // form.method = 'post';
            }
            form.submit();

        } else {

            alert('حداقل یک گزینه را انتخاب کنید !');

            event.stopPropagation();
            event.preventDefault();
        }


    };

    function check_Confirm(num,action) {

        var message;
        // message for one item
        if (num === 0) {
            message = 'آیا از حذف این مورد اطمینان دارید ؟';
            if (confirm(message)) {
                return true;
            } else {
                event.stopPropagation();
                event.preventDefault();
            }
        } else {
            if (this.chk_selection()) {
                // message selected items
                message = 'آیا از حذف موارد انتخاب شده اطمینان دارید ؟';
                if (confirm(message)) {
                    this.submitForm('delete', action);
                    return true;
                } else {
                    event.stopPropagation();
                    event.preventDefault();
                }
            } else {
                alert('حداقل یک گزینه را انتخاب کنید !');
                event.stopPropagation();
                event.preventDefault();
            }
        }
    }

    // jQuery.noConflict();

</script>
