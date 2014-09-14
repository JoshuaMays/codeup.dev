<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Moment JS -->
    <script src="js/moment.js"></script>
    <script>
        var dates = document.getElementsByClassName("listDate");
        for (var i = 0; i < dates.length; i++) {
            var date = dates[i];
            moment(date.innerText, "YYYY-MM-DD").fromNow();
        }
    </script>
</body>
</html>