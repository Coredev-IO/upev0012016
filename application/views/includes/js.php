<script src="<?=base_url()?>/principal/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>/principal/js/theter.js"></script>
<script src="<?=base_url()?>/principal/js/bootstrap.min.js"></script>

<script type="text/javascript">
        $('form').attr('autocomplete', 'off');

        $('.loader').hide();

        // $('a').click(function(){
        //         $('.loader').show();
        //         var www = this.href;
        //             var f = function(){ $('.loader').hide();
        //             window.location.href=www };
        //             setTimeout(f,800);
        //             return false;

        // });

        // $('button').click(function(){
        //         $('.loader').show();

        // });




        // $(function(){
        //     $("button[type='submit']").click(function(){
        //         var $fileUpload = $("input[type='file']");
        //         if (parseInt($fileUpload.get(0).files.length)>2){
        //          alert("You can only upload a maximum of 2 files");
        //         }
        //     });
        // });


        // $(function(){
        //
        //
        //         $("input[name=datafile2]").on('change', function(){
        //
        //                 var $fileUpload = $("input[name=datafile2]");
        //                 if (parseInt($fileUpload.get(0).files.length)>3){
        //                         alert("Sólo se pueden adjuntar máximo 3 archivos");
        //                         reset($("input[name=datafile2]"));
        //                 }
        //
        //         });
        // });
        //
        //
        // //FUNCION PARA RESET DE CAMPOS
        // window.reset = function (e) {
        //         e.wrap('<form>').closest('form').get(0).reset();
        //         e.unwrap();
        // }
</script>
