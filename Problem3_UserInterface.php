<?php
/*
Problem 3 Solution

Should be able to paste this file into here and view: https://www.w3schools.com/php/phptryit.asp?filename=tryphp_compiler
*/

// Object to hold name and dimensions of an item
class Item {
	private $id;
	private $name;
    private $weight;
    private $length;
    private $width;
    private $height;
    
    function __construct($name, $weight, $length, $width, $height) {
        $this->name = $name;
        $this->weight = $weight;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }
    
    // Getters / Setters for all fields
    function get_id() { return $this->id; }
    
    function set_id($id) { $this->id = $id; }
    
    function get_name() { return $this->name; }
    
    function set_name($name) { $this->name = $name; }
  
  	function get_weight() { return $this->weight; }
    
    function set_weight($weight) { $this->weight = $weight; }
  
  	function get_length() { return $this->length; }
    
    function set_length($length) { $this->length = $length; }
  
  	function get_width() { return $this->width; }
    
    function set_width($width) { $this->width = $width; }
  
  	function get_height() { return $this->height; }
    
    function set_height($height) { $this->height = $height; }
    
}

// Object that stores our items
class Inventory {
	private $items = array();
    private $counter = 1;
    
    function __construct() {
    	$this->add_item(new Item("Fiddle", 1, 60, 20, 10));
    	$this->add_item(new Item("Dish", 0.1, 30, 30, 5));
        $this->add_item(new Item("Spoon", 0.05, 15, 5, 2));
    }
    function get_counter() {return $this->counter;}
    // Get items array
    function get_items() { return $this->items; }
    
    // Add to items array
    function add_item(&$item) {
    	$item->set_id($this->counter);
        $this->counter++;
    	$this->items[] = $item;
    }
    
    // Remove from items array
    function remove_item($id) {
    $removeIndex = array_search($id,$items); // get index of item to remove
    array_splice($this->items[], $removeIndex, 1);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

<style>
h1 {color: #f0723d;}
body {color: black; font-family: 'Montserrat', sans-serif;}
table {border-collapse: collapse; width: 80%; max-width: 100%;}
th, td {border: 1px solid black; padding: 2px; max-width: 40px;}
th {background-color: #f0723d;}
.editableCells {max-width: 80%;}
span {color: red}
</style>

</head>
<body>
<div class="wrapper">
<?php
// Initializing our Inventory object
$inventory = new Inventory();
$items = $inventory->get_items();

echo '<h1>Problem 3 Solution</h1>';

// Table Header
echo '<table id="dataTable">';
echo '<tr>';
echo '<th>Name</th><th>Weight</th><th>Length</th><th>Width</th><th>Height</th><th>Delete</th>';
echo '</tr>';

// Table Data
foreach ($items as $item) {
	echo '<tr>';
    echo '<td class="editable">'.$item->get_name().'</td>';
    echo '<td class="editable">'.$item->get_weight().'</td>';
    echo '<td class="editable">'.$item->get_length().'</td>';
    echo '<td class="editable">'.$item->get_width().'</td>';
    echo '<td class="editable">'.$item->get_height().'</td>';
    echo '<td>
    	<button id="deleteBtn">Delete</button>
        <button id="editBtn" value="edit">Edit</button>
        </td>';
    echo '</tr>';
}
echo '</table>';
echo '<button id="submitBtn">Submit Changes</button>';

// Add new item form
echo '<h2>Add New Item</h2>';
echo '<form name="addCustomer" id="addCustomer" method="post">';
echo '<input type="text" id="nameInput" name="nameInput" placeholder="Name"><br />';
echo '<input type="text" id="weightInput" name="weightInput" placeholder="Weight"><br />';
echo '<input type="text" id="lengthInput" name="lengthInput" placeholder="Length"><br />';
echo '<input type="text" id="widthInput" name="widthInput" placeholder="Width"><br />';
echo '<input type="text" id="heightInput" name="heightInput" placeholder="Height"><br />';
echo '<input type="submit" value="Add New Item"></td></tr><br>';
echo '<span id="error"><span>';
?>

<script type="text/javascript">
	$(document).ready(function() {
		// Getting input for add item form and passing to validation method
    	$('#addCustomer').submit(function() {
            var name = $("#nameInput").val();
            var weight = $("#weightInput").val();
            var length = $("#lengthInput").val();
            var width = $("#widthInput").val();
            var height = $("#heightInput").val();
            formValidation(name,weight,length,width,height);
        });
        
        // Validates add item input and adds item or shows error
        function formValidation(name, weight, length, width, height) {
        	var findLetters = /^[A-Za-z]+$/;
            var errorMessage = "";
        
        	if (!height) errorMessage = "Height cant be empty";
            if (findLetters.test(height)) errorMessage = "Height cant include letters";
            
            if (!width) errorMessage = "Width cant be empty";
            if (findLetters.test(width)) errorMessage = "Width cant include letters";
        	
            if (!length) errorMessage = "Length cant be empty";
            if (findLetters.test(length)) errorMessage = "Length cant include letters";
            
            if (!weight) errorMessage = "Weight cant be empty";
            if (findLetters.test(weight)) errorMessage = "Weight cant include letters";
            
            if (!name) errorMessage = "Name cant be empty";
            if (!findLetters.test(name) && name != "") errorMessage = "Name cant include numbers!";
            
            
            if (errorMessage) {
            	$('#error').text(errorMessage);
                return false;
            }
            
            // Need to look more into communicating with PHP
            //addItem();
            
            var tableRow = `<tr><td class="editable">${name}</td><td 								class="editable">${weight}</td><td class="editable">${length}</td><td 							class="editable">${width}</td><td class="editable">${height}</td><td><button 					id="deleteBtn">Delete</button><button id="editBtn">Edit</button></tr>`;
            
            $('#dataTable tr:last').after(tableRow);
            $('#addCustomer').trigger("reset");
            $('#error').text("");
            
        }
        
        // Add an item to the server and returns the id
        function addItem() {
        	<?php 
            
            	$name = $_POST["nameInput"];
                $weight = $_POST["weightInput"];
                $length = $_POST["lengthInput"];
                $width = $_POST["widthInput"];
                $height = $_POST["heightInput"];
            
            $newItem = new Item($name,$weight,$length,$width,$height);
            $inventory->add_item($newItem); ?>
            return '<?php echo $inventory->get_counter(); ?>';
        }
        
        
        // To remove an item
        $(document).on('click','#deleteBtn', function() {
  			$(this).closest('tr').remove();
		});
        
        // To edit values
        $(document).on('click','#editBtn', function() {
            $(this).attr("disabled", true);
            $(this).parents('tr').find('td.editable').each(function() {
              var html = $(this).html();
              var input = $('<input class="editableCells" type="text" />');
              input.val(html);
              $(this).html(input);
            });
        
});

		 // Submit just refreshes the page
        $("#submitBtn").click(function(){
  			alert("Submitted!");
            location.reload();
		});
        
    });
</script>
</div>
</body>
</html>


