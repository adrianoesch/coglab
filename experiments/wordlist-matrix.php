<!doctype html>
<html>
    <head>
        <title>Coglab Experiment</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../jsPsych-4.3/jspsych.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-text.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-single-stim.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-fullscreen.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-response-table.js"></script>
        <script src="../jsPsych-4.3/plugins/jspsych-save-get-vars.js"></script>
        <link href="../jsPsych-4.3/css/jspsych.css" rel="stylesheet" type="text/css"></link>
    </head>
    <body>
    </body>
    <script>
      // settings
      var url = document.location.toString();
      var experiment_name =  url.split('/')[url.split('/').length-1].split('.')[0];
      var subjectID = 'hans_wurst';

      // prepare structures
        // /* define welcome message block */
        // var welcome_block = {
        //   type: "text",
        //   text: "Welcome to the experiment. Press any key to begin."
        // };

        /* define instructions block */
        var instructions_block = {
          type: "text",
          text: "<p style='text-align:center;'>Bli bla blo blu ... Press a key.</p>",
          timing_post_trial: 2000
        };

        /* prepare word blocks */
        var words = ['eins','zwei','drei','vier','fuenf','sechs','sieben','acht','neun','zehn','elf','zwoelf','dreizehn','vierzehn','fuenfzehn'];
        var colors = ['blue','blue','blue','blue','blue','red','red','red','red','red'];
        var color_dic = {'red':'#FF0000','blue':'#0000FF'}

        var words_shuffled = words.slice(0,10);
        var words_shuffled = words_shuffled.sort(function() { return(0.5-Math.random())});
        var colors_shuffled = colors.sort(function() { return(0.5-Math.random())});
        var screen_width = screen.width;
        var screen_height = screen.height;
        var centerX = screen_width*0.5
        var centerY = screen_height*0.5
        var fullScreenDiv_style = "position:absolute;left:0;top:0;height:"+screen_height+"px;width:"+screen_width+"px;";
        var p_style = "margin-top:"+(centerY-50)+"px;text-align:center;"+
                      "font-weight:bold;font-size:100px;";

        html_words = [];
        for(i=0;i<10;i++){
          html_words.push("<div style='"+fullScreenDiv_style+"'>"+
          "<p style='"+p_style+"color:"+color_dic[colors_shuffled[i]]+";'>"+words_shuffled[i]+"</p></div>");
        }

        var crossTable = "<table align='center' style='margin-top:"+(centerY-100)+"px;text-align:center;font-weight:bold;font-size:100px;border-collapse:collapse;'>"+
                                   "<tr><td style='height:100px;width:100px;border-right:4px solid black;border-bottom:4px solid black;'/>"+
                                      "<td style='height:100px;width:100px;border-left:4px solid black;border-bottom:4px solid black;'/></tr>"+
                                  "<tr><td style='height:100px;width:100px;border-right:4px solid black;border-top:4px solid black;'/>"+
                                      "<td style='height:100px;width:100px;border-left:4px solid black;border-top:4px solid black;'/></tr></table>";
        var centeredCross = "<div style='"+fullScreenDiv_style+"'>"+crossTable+"</div>"


        var word_presentation = {
            type: 'single-stim',
            stimuli: html_words,
            is_html: true,
            timing_stim: 200,
            timing_response: 200,
            timing_post_trial: 200,
            response_ends_trial: false
        }

        var cross_center = {
            type: 'single-stim',
            stimuli: centeredCross,
            is_html: true,
            timing_post_trial: 200,
            timing_stim: 1000,
            timing_response: 1000,
            response_ends_trial: false
        }

        words_shuffled2 = words.sort(function() { return(0.5-Math.random())})

        var response_block = {
          type : "response-table",
          words : words_shuffled2,
          rows : 3,
          cols : 5,
          tdStyle : "height:80px;width:150px;font-size:25px;padding:15px;text-align:center;",
          tableStyle: "margin-top:200px;"
        }

        var activate_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">Welcome <br><br> Please continue to enter into full screen mode.<br><br>',
            buttonStyle : 'float:right;',
            buttontext: "Enter"
        }

        var end_fullscreen = {
            type: 'fullscreen',
            showtext: '<p style="padding-top: 50px; text-align: center;">Thank you for participating!<br><br> Please save your responses before you close the window.',
            buttonStyle : 'float:right;',
            buttontext: "Exit",
            exit: true
          }


          function saveData(subjectID,experiment_name,dataAsCSV,dataAsJSON){
           $.ajax({
              type: 'post',
              cache: false,
              url: '../store.php', // this is the path to the above PHP script
              data: {subjectID: subjectID, folder: experiment_name,dataAsCSV: dataAsCSV, dataAsJSON: dataAsJSON}
           });
          }


        var save_get_block = {
            type: 'save-get-vars',
            all: "True"
          }

        /* create experiment definition array */
        var experiment = [];
        // experiment.push(save_get_block);
        // experiment.push(activate_fullscreen);
        // experiment.push(instructions_block);
        // experiment.push(cross_center);
        // experiment.push(word_presentation);
        experiment.push(response_block);
        // experiment.push(end_fullscreen);


        /* start the experiment */
        jsPsych.init({
          experiment_structure: experiment,
          on_finish: function(){ saveData(subjectID,experiment_name,jsPsych.data.dataAsCSV(),jsPsych.data.dataAsJSON()) }
          // on_finish: function() {jsPsych.data.displayData('JSON')}
        });
      </script>
</html>
