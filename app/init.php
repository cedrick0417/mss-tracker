
<?php

require_once 'config.php';



// HOME TABLE
require_once 'models/HomeTableModel.php';
require_once 'controllers/HomeTableController.php';
// require 'app/views/hometable.php';


// RAL TABLE
require_once 'models/RalTableModel.php';
require_once 'controllers/RalTableController.php';

// CRO TABLE
require_once 'models/CroTableModel.php';
require_once 'controllers/CroTableController.php';

// NMM TABLE
require_once 'models/NmmTableModel.php';
require_once 'controllers/NmmTableController.php';


// if (isset($_POST['selected_class'])) {
//     $classType = $_POST['selected_class'];

//     switch ($classType) {
//         case 'ClassA':
//             $controller = new HomeTableController();
//             $controller->handleRequestHome();
//             break;
//         case 'ClassB':
//             $controller = new RalTableController();
//             $controller->handleRequestRal();
//             break;
//         case 'ClassC':
//             $controller = new CroTableController();
//             $controller->handleRequestCro();
//             break;
//         default:
//             die('Invalid class type');
//     }

//     // $classInstance->run();
// }

$controller = new HomeTableController();
$controller->handleRequestHome();

$controller = new RalTableController();
$controller->handleRequestRal();

$controller = new CroTableController();
$controller->handleRequestCro();

$controller = new NmmTableController();
$controller->handleRequestNmm();
?>

<!-- <label for="selected_class">Select a class:</label>
    <select name="selected_class" id="selected_class">
        <option value="ClassA">Home</option>
        <option value="ClassB">Refund Activity Logs</option>
        <option value="ClassC">Consumer Request Origin</option>
    </select>

    <div id="result"></div> -->

    <!-- Add JavaScript to handle the select change and make an AJAX request -->
    <!-- <script>
        const selectElement = document.getElementById('selected_class');
        const resultDiv = document.getElementById('result');

        selectElement.addEventListener('change', function() {
            const selectedValue = this.value;

            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Display the result in the resultDiv
                    resultDiv.innerHTML = this.responseText;
                }
            };
            xhttp.open('POST', window.location.href, true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send('selected_class=' + selectedValue);
        });
    </script> -->