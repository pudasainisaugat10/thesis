<?php
// Process appointment application form submission and display a success alert when the 'submit' button is clicked.
$appoint = new DatabaseTable('appointment');

if (isset($_POST['submit'])) {

  $data = [
    'username' => $_POST['name'],
    'contact' => $_POST['contact'],
    'provider' => $_POST['provider'],
    'problem' => $_POST['problem'],
    'time' => $_POST['time'],
    'date' => $_POST['date']
  ];

  $appoint->save($data, 'id');
  echo '<script language="javascript">';
  echo 'alert("Appointment Successfully Applied...")';
  echo '</script>';
}
?>

<div class="container mx-auto mt-6 py-20 space-x-4">
  <div class="flex justify-center items-center mb-6">
    <hr class="h-1 w-16 bg-pink-300 mx-2" />
    <h1 class="text-4xl font-bold">Health Providers</h1>
    <hr class="h-1 w-16 bg-green-300 mx-2" />
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 py-3 space-x-4">
    <!-- Provider 1 -->
    <?php
    $provider = new DatabaseTable('provider');
    $row = $provider->findAll();
    foreach ($row as $row1) {
    ?>
      <div id="" class="bg-white rounded-lg p-4 shadow-md hover:scale-110 transform hover:shadow-xl duration-300 space-x-4">
        <img src="images/person1.png" alt="" class="w-24 h-24 rounded-full bg-contain" />
        <p class="font-light text-blue-500 text-sm underline">Department:
          <?php echo $row1['department'];  ?>
        </p>
        <h2 class="text-lg font-semibold">Dr. <?php echo $row1['name'];  ?></h2>
        <h3 class="text-gray-600">Email: <?php echo $row1['email'];  ?></h3>
        <p class="text-gray-600">Contact: <?php echo $row1['contact'];  ?></p>
        <p class="text-gray-600">Addres: <?php echo $row1['address'];  ?></p>
        <p class="text-gray-600">Qualification: <?php echo $row1['qualification'];  ?></p>
      </div>
    <?php } ?>


  </div>
</div>

<div class="py-20 flex justify-evenly">
  <button onclick="handleShowForm()" class="bg-green-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded-lg">
    Book Appointment
  </button>
</div>

<div id="planForm" class="hidden fixed inset-0 flex items-center justify-center">
  <div class="absolute bg-black opacity-60 inset-0"></div>
  <div class="relative bg-white p-8 shadow-lg rounded-lg w-1/2">
    <h2 class="text-2xl font-semibold mb-4 flex justify-center">
      Book Your Appointment
    </h2>
    <form action="" method="POST">
      <div class="flex flex-row justify-evenly space-x-4">
        <div class="mb-4 w-1/3">
          <label for="providerSelect" class="block text-gray-700 text-sm font-bold mb-2">Select Provider:</label>
          <select id="providerSelect" name="provider" class="w-full border rounded py-2 px-3">
            <?php
            $provider = new DatabaseTable('provider');
            $row = $provider->findAll();
            foreach ($row as $row1) {
            ?>
              <option value="<?php echo $row1['name'];  ?>"> DR <?php echo $row1['name'];  ?></option>
            <?php
            }
            ?>
          </select>
        </div>



        <div class="mb-4 w-1/3">
          <label class="block font-semibold mb-2">Classes Time:</label>
          <select id="appointmentTime" name="time" class="border rounded px-2 py-1 w-1/2" required>
            <option value="9:00 AM">9:00 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="11:00 AM">11:00 AM</option>
          </select>
        </div>
      </div>

      <div class="flex flex-row space-x-4">
        <div class="mb-4 w-1/2">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
          <input type="text" id="name" name="name" class="w-full border rounded py-2 px-3" required />
        </div>

        <div class="mb-4 w-1/2">
          <label for="tel" class="block text-gray-700 text-sm font-bold mb-2">Contact</label>
          <input type="number" name="contact" id="tel" class="w-full border rounded py-2 px-3" required />
        </div>
      </div>
      <div class="flex flex-row space-x-4">
        <div class="mb-4 w-1/2">
          <label class="block text-gray-600">Problem Statement:</label>
          <textarea name="problem" class="border rounded-md px-3 py-2 w-full" rows="4" required></textarea>
        </div>
        <div class="mb-4 w-1/2">
          <label for="dob" class="block mb-1">Date:</label>
          <input type="date" name="date" id="date" class="w-1/2 p-2 border border-gray-300 rounded bg-white" required />
        </div>
      </div>

      <div>
        <label class="font-semibold py-2">Price: 10</label>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-2">Payment Via:</label>
        <div class="flex justify-evenly">
          <div>
            <label>
              <input type="radio" name="payment" value="Cash on Office" class="mr-1" />
              Cash on Office , Or
            </label>
          </div>

        </div>
        <div class="flex justify-evenly mt-5 mr-14">
          <div>
            <label>
              <input id="khalti" type="radio" name="payment" value="Khalti" class="mr-1" />
              Khalti
            </label>
          </div>
        </div>

        <button id="payment-button" style="display: none;" class="bg-green-500 text-white font-medium rounded-md py-2 px-4 shadow-sm hover:bg-gray-500">Pay with Khalti</button>
        <script>
          var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_a9cf3dd5c58c4a0aa45b92d8d8d8c33f",
            "productIdentity": "01",
            "productName": "HealthService",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
              "KHALTI",
              "EBANKING",
              "MOBILE_BANKING",
              "CONNECT_IPS",
              "SCT",
            ],
            "eventHandler": {
              onSuccess(payload) {
                // hit merchant api for initiating verfication
                console.log(payload);

                <?php
                $args = http_build_query(array(
                  'token' => 'QUao9cqFzxPgvWJNi9aKac',
                  'amount'  => 10
                ));

                $url = "https://khalti.com/api/v2/payment/verify/";

                # Make the call using API.
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $headers = ['Authorization: Key test_secret_key_b87d62517e754c9cbbe2be587a94ef8e'];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                // Response
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                function console_log($output, $with_script_tags = true)
                {
                  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
                    ');';
                  if ($with_script_tags) {
                    $js_code = '<script>' . $js_code . '</script>';
                  }
                  echo $js_code;
                }
                ?>
              },
              onError(error) {
                console.log(error);
              },
              onClose() {
                console.log('widget is closing');
              }
            }
          };

          var checkout = new KhaltiCheckout(config);
          var btn = document.getElementById("payment-button");
          btn.onclick = function() {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({
              amount: 1000
            });
          }
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
          // Show the "payment-button" element when the element with id "khalti" is clicked, using jQuery.
          $(document).ready(function() {
            $("#khalti").click(function() {

              $("#payment-button").show();
            });
          });
        </script>
      </div>
      <div class="flex justify-center">
        <input type="submit" value="Get Appointment" name="submit" class="bg-green-500 text-white font-medium rounded-md py-2 px-4 shadow-sm hover:bg-gray-500">

        <button onclick="handleHideForm()" class="ml-4 bg-red-500 text-white text-base font-medium rounded-md py-2 px-4 shadow-sm hover:bg-red-600">
          Close
        </button>
      </div>
    </form>
  </div>
</div>

</body>

<script>
  // JavaScript to handle form submission
  function handleShowForm() {
    document.getElementById("planForm").classList.remove("hidden");
  }

  function handleHideForm() {
    document.getElementById("planForm").classList.add("hidden");
  }
</script>