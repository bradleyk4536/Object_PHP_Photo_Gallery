  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<!--    WYSIWYG-->
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
<!--    dropzone.js for drag and drop of files-->
	 <script src="js/dropzone.js"></script>
<!--    script for tinymce editor-->
    <script src="js/scripts.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',       <?php echo $session->session_count; ?>],
          ['Photos',      <?php echo Photo::count_all(); ?>],
          ['Users',       <?php echo User::count_all(); ?>],
          ['Comments',    <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
			  legend: 'none',
			  pieSliceText: 'label',
           title: 'Photo Gallery Status',
			  backgroundColor: 'transparent',
			  slices: {

			  0: {color: 'blue'},
			  1: {color: 'green'},
			  2: {color: 'orange'},
			  3: {color: 'red'}
		  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
