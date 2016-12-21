<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->


</head>
<body>


<div class="form-horizontal question"  id="templateF" style="display: none;">
    <div class="form-control">
        <p id="question"> </p>
    </div>
    <br>
    <div class="form-group" >

        <label class="col-sm-2 col-lg-2 control-label" >reponse:</label>
        <div class="col-sm-10 col-lg-10">
            <textarea id="focusedInput" type="text" class="form-control"  value="Click to focus" ></textarea>
        </div>
    </div>
    <br>
</div>

<div class="form-horizontal question" id="templateL"style = "display: none" >
    <div class="form-control">
        <p id="question"> </p>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-01">
            <input  name="sample-radio" id="radio-01" value="1" type="radio" checked="">
        </label>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-02">
            <input  name="sample-radio" id="radio-02" value="1" type="radio">
        </label>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-01">
            <input  name="sample-radio" id="radio-01" value="1" type="radio" checked="">
        </label>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-01">
            <input  name="sample-radio" id="radio-01" value="1" type="radio" checked="">
        </label>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-01">
            <input  name="sample-radio" id="radio-01" value="1" type="radio" checked="">
        </label>
    </div>
    <br>
</div>

<div class="form-horizontal question"  id="templateD"   style = "display: none" >
    <div class="form-control">
        <p id="question"> </p>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-01">
            <input   id="radio-01" name ='dich' value="1" type="radio" checked>
        </label>
    </div>
    <div class="form-control">
        <label class="label_radio" for="radio-02">
            <input   id="radio-02" name ='dich' value="1" type="radio">
        </label>
    </div>
    <br>
</div>



<div class="form-horizontal question"  id="templateS" style="display: none;">
    <div class="form-control">
        <p id="question" > </p>
    </div>

    <div class="form-control" id="before">
        <div>
            <input id="other" name ='other' type="radio" value="" checked>Autre :<input id="other_value" type="text"  >
        </div>
    </div>
    <br>
</div>


<div class="form-horizontal question"  id="templateM" style="display: none;">
    <div class="form-control">
        <p id="question" > </p>
    </div>


    <div class="form-control" id="before">
        <div>
            <input id="other" name ='other' type="checkbox" value="" checked>Autre :<input id="other_value" type="text"  >
        </div>
    </div>

    <br>
</div>


<div class='form-control' id="radio" style="display: none;">
    <label class='label_radio' for='radio-02'>
        <input  value='1' type='radio' >
    </label>
</div>

<div class='form-control' id="checkBox" style="display: none;">
    <label class='label_check' for='check'>
        <input id='check' value='1' type='checkbox'>
    </label>
</div>

<div class="col-lg-2 side"></div>

<div class="col-lg-8 middle">
    <div id="surveyInfo" class="center-block">
        <h3 id="surveyName">Nom De Sondage :</h3>
        <h4 id="module">Module Ou Service :</h4>
        <h4 id="fin">Date de La Fin :</h4>
        <h4>Description:</h4>
        <p id="description"></p>

    </div>
    <div id="res">

    </div>
</div>
<div class="col-lg-2 side "></div>
</body>


</html>

<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

<!--custom switch-->
<script src="js/bootstrap-switch.js"></script>
<!--custom tagsinput-->
<script src="js/jquery.tagsinput.js"></script>
<!--custom checkbox & radio-->
<script type="text/javascript" src="js/ga.js"></script>


<script src="js/respond.min.js" ></script>


<!--common script for all pages-->
<script src="js/common-scripts.js"></script>

<!--script for this page-->

<script>
    $(document).ready(function(){
        nbDich = 1;
        nbSimple = 1;
        nbMultiple = 1;
        nbLevel = 1;
        // free = 1;

        var id = window.location.search.substr(4,window.location.search.length);
        $.post('getSurveyInfo.php',{id : id},function(data){
            data = JSON.parse(data);
            $('#surveyName').append(data['name']);
            $('#module').append(data['module']);
            $('#fin').append(data['fin'].substring(0,10));
            $('#description').html(data['description']);
        });
        $.post('getSurveyParticipate.php',{id : id},function(data){
            data = JSON.parse(data);//alert(data.length);
            for(var i = 0 ; i < data.length ;i++){
                switch (data[i][2]){
                    case 'dich':
                        var dich = $('#templateD').clone();
                        dich.attr('id', data[i][0]);
                        dich.attr('type',data[i][2]);
                        dich.css('display', 'block');
                        dich.find('p').html(data[i][1]);
                        var j = 0;
                        dich.find('input').each(function () {
                            $(this).after(data[i][3][j][1]);
                            $(this).attr('value',data[i][3][j][0]);
                            $(this).attr('name','dich'+nbDich);
                            j++;
                        });
                        nbDich++;
                        $('#res').append(dich);
                        break;

                    case 'simple':
                        var simple = $('#templateS').clone();
                        simple.attr('id',data[i][0]);
                        simple.attr('type',data[i][2]);
                        simple.css('display','block');
                        simple.find('p').html(data[i][1]);
                        for(var j = 0; j < data[i][3].length; j++){
                            var radio = $('#radio').clone();
                            radio.attr('id','');
                            radio.css('display','block');
                            radio.find('input').after(data[i][3][j][1]);
                            radio.find('input').attr('value',data[i][3][j][0]);
                            radio.find('input').attr('name','simple'+nbSimple);
                            simple.find('#before').before(radio);
                        }
                        simple.find('#other').attr('name','simple'+nbSimple);
                        nbSimple++;
                        $('#res').append(simple);
                        break;

                    case 'multiple':
                        var multiple = $('#templateM').clone();
                        multiple.attr('id',data[i][0]);
                        multiple.attr('type',data[i][2]);
                        multiple.css('display','block');
                        multiple.find('p').html(data[i][1]);
                        for(var j = 0; j < data[i][3].length; j++){
                            var check = $('#checkBox').clone();
                            check.attr('id','');
                            check.css('display','block');
                            check.find('input').after(data[i][3][j][1]);
                            check.find('input').attr('value',data[i][3][j][0]);
                            check.find('input').attr('name','multiple'+nbMultiple+'[]');
                            multiple.find('#before').before(check);
                        }
                        multiple.find('#other').attr('name','multiple'+nbMultiple+'[]');
                        nbMultiple++;
                        $('#res').append(multiple);
                        break;

                    case 'level':
                        var level = $('#templateL').clone();
                        level.attr('id',data[i][0]);
                        level.attr('type',data[i][2]);
                        level.css('display','block');
                        level.find('p').html(data[i][1]);
                        var j = 0;
                        level.find('input').each(function(){
                            $(this).after(data[i][3][j][1]);
                            $(this).attr('value',data[i][3][j][0]);
                            $(this).attr('name','level'+nbLevel);
                            j++;
                        });
                        nbLevel++;
                        $('#res').append(level);
                        break;
                    case 'free':
                        var free = $('#templateF').clone();
                        free.attr('id',data[i][0]);
                        free.attr('type',data[i][2]);
                        free.css('display','block');
                        free.find('p').html(data[i][1]);
                        $('#res').append(free);
                        break;
                }
            }
        });
    });

</script>
<style>
    .question{
        padding: 20px;
        margin: 10px;
        border: groove #000000 1px;
        border-radius:6px ;
    }
    #surveyInfo{
        border:1px solid #8FB39F;
        padding: 20px;
        margin: 10px;
        background:beige;
    }
    .side{
        background: rgba(143, 179, 159, 1);
        min-height: 700px;
    }
    .middle{
        background: white;
        min-height: 700px;
    }
</style>
