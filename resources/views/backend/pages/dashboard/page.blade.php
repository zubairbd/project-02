<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        label {
            display: block;
            }

            #select-all {
            margin-bottom: 20px;
            }
    </style>
</head>
<body>
    <label><input type="checkbox" id="select-all" />Choose all</label>

<label><input type="checkbox"/>Option 1</label>
<label><input type="checkbox"/>Option 2</label>
<label><input type="checkbox"/>Option 3</label>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    var selectAllItems = "#select-all";
    var checkboxItem = ":checkbox";

    $(selectAllItems).click(function() {
    
    if (this.checked) {
        $(checkboxItem).each(function() {
        this.checked = true;
        });
    } else {
        $(checkboxItem).each(function() {
        this.checked = false;
        });
    }
    
    });
</script>
</body>
</html>