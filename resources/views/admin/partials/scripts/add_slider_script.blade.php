<script type="text/javascript">
    $(document).ready(function () {
        // var c_ac_input = $("#count_of_activity_input").val();
        // var c_ac_input = 2;
        var c_ac_input = $("#count_of_sliders").val();

        var ac_wrapper = $(".ac_wrapper");

        $('#add_btn').click(function (e) {
            e.preventDefault();
            $('.ac_wrapper').append(
                '   <div class="col-12">  ' +
                '       <div class="form-group row">  ' +
                '       <div class="col-md-2 ">  ' +
                '       <span>عنوان</span>  ' +
                '<label class=" btn_delete danger">حذف</label>' +
                '       </div>  ' +
                '       <div class="col-md-8">  ' +
                '<input type="hidden" name="rows['+c_ac_input+'][ac_id]"> '+
                '       <input type="text" id="pic" required  ' +
                '   class="form-control "  ' +
                '   name="rows[' + c_ac_input + '][ac_image]" min="1" style="direction: ltr;text-align: left">  ' +
                '       </div>  ' +
                '       <div class="col-md-2">  ' +
                '       <input type="number" id="order" required  ' +
                '   class="form-control"  ' +
                '   name="rows[' + c_ac_input + '][ac_order]" value="' + c_ac_input + '">  ' +
                '       </div>  ' +
                '       </div>  ' +
                '       </div>  '
            );
            c_ac_input++;

        });
        $(ac_wrapper).on("click", ".btn_delete", function (e) {
            e.preventDefault();
            var input_id = $(this).parent().parent().attr('id');
            console.log(input_id);
            $("#deleted_rows").val(function () {
                return this.value + input_id + ',';
            });
            $(this).parent().parent().remove();
        });


    });


</script>
