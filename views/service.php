<?php
// If the user is logged in, retrieve user data, process plan application form submission, and display a success alert.
if (isset($_SESSION['login'])) {
  $getid = $_SESSION['login'];
  $user = new DatabaseTable('users');
  $row = $user->find('id', $getid);
  $user = $row->fetch();

  $article = new DatabaseTable('applied_plans');

  if (isset($_POST['submit'])) {

    $data = [
      'category' => $_POST['category'],
      'user_name' => $user['name'],
      'height' => $_POST['height'],
      'weight' => $_POST['weight'],
      'class_time' => $_POST['time'],
      'facility' => $_POST['facility'],
      'goals' => $_POST['goals'],
      'date' => $_POST['date'],
      'payment' => $_POST['payment'],
      'status' => 'pending'
    ];

    $article->save($data, 'id');
    echo '<script language="javascript">';
    echo 'alert("Plan Successfully Applied...")';
    echo '</script>';
  }
}
?>


<div class="mt-14 py-3">
  <div class="flex justify-center items-center mb-6">
    <hr class="h-1 w-16 bg-red-300 mx-2" />
    <h1 class="text-4xl font-bold">Health Services</h1>
    <hr class="h-1 w-16 bg-blue-300 mx-2" />
  </div>
  <div class="flex flex-row">
    <div class="w-1/4">
      <img src="images/pr7.jpg" alt="" class="px-10 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
      <h2 class="text-3xl flex justify-center">Personal Training</h2>
      <p class="flex justify-center text-sm font-medium mt-2">
        Get one-on-one coaching from expert trainers
      </p>
      <p class="flex justify-center text-sm font-medium">
        to achieve your fitness goals.
      </p>
    </div>
    <div class="w-1/4">
      <img src="images/pr8.jpg" alt="" class="px-10 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
      <h1 class="text-3xl flex justify-center">Customized Workout Plan</h1>
      <p class="flex justify-center text-sm font-medium mt-2">
        Create a tailored workout plan that aligns
      </p>
      <p class="flex justify-center text-sm font-medium">
        with your goals.
      </p>
    </div>
    <div class="w-1/4">
      <img src="images/pr10.jpg" alt="" class="px-10 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
      <h1 class="text-3xl flex justify-center">Personalized Fitness</h1>
      <h2 class="text-3xl flex justify-center">Coaching</h2>
      <p class="flex justify-center text-sm font-medium mt-2">
        Get a personalized workout plan created by
      </p>
      <p class="flex justify-center text-sm font-medium">
        professional trainers to assist you in
      </p>
      <p class="flex justify-center text-sm font-medium">
        exceeding your fitness objectives.
      </p>
    </div>
    <div class="w-1/4">
      <img src="images/pr11.jpg" alt="" class="px-9 mx-1 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
      <h1 class="text-3xl flex justify-center">Group Fitness Classes</h1>
      <p class="flex justify-center text-sm font-medium mt-2">
        Join our active community to discover inspiration
      </p>
      <p class="flex justify-center text-sm font-medium">
        in a variety of engaging and challenging
      </p>
      <p class="flex justify-center text-sm font-medium">
        group activities.
      </p>
    </div>
  </div>

  <div class="flex justify-end py-3">
    <hr class="h-px align-middle justify-center bg-red-200 border-0 w-full flex-1 mt-5" />
    <button class="hover:bg-gray-700 text-slate-400 font-bold py-1 rounded-lg px-2" onclick="toggleView()">
      View More
    </button>
  </div>
  <div id="moreContent" style="display: none">
    <div class="flex flex-row space-x-4">
      <div class="w-1/4">
        <img src="images/pr6.jpg" alt="" class="px-10 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
        <h2 class="text-3xl flex justify-center">Progress and Feedback</h2>
        <p class="flex justify-center text-sm font-medium mt-2">
          Get one-on-one coaching from expert trainers to achieve
        </p>
        <p class="flex justify-center text-sm font-medium">
          your fitness goals with a customized workout plan.
        </p>
      </div>
      <div class="w-1/5">
        <img src="images/pr15.jpg" alt="" class="px-10 mt-10 hover:scale-110 transform hover:shadow-xl duration-300 rounded-lg" />
        <h1 class="text-3xl flex justify-center">Yoga & Meditation</h1>
        <p class="flex justify-center text-sm font-medium mt-2">
          Join our community of fitness enthusiasts and get motivated
        </p>
      </div>
    </div>
  </div>
</div>

<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

<?php
if (isset($_SESSION['login'])) {
?>
  <div class="flex justify-evenly py-7 mt-2">
    <button onclick="handleShowForm()" class="bg-green-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded-lg">
      Create Plan
    </button>
  </div>

  <?php
  // Retrieve user data based on the 'id' stored in the 'login' session variable.
  $getid = $_SESSION['login'];
  $user = new DatabaseTable('users');
  $row = $user->find('id', $getid);
  $user = $row->fetch();

  ?>

  <div id="planForm" class="hidden fixed inset-0 flex items-center justify-center">
    <div class="absolute bg-black opacity-60 inset-0"></div>
    <div class="relative bg-white p-8 shadow-lg rounded-lg w-1/2">
      <h2 class="text-2xl font-semibold mb-4 flex justify-center">
        Create Your Plan
      </h2>
      <form action="" method="POST">
        <input type="hidden" name="category" value="Service">

        <div class="flex flex-row justify-evenly">
          <div class="mb-4">
            <label class="block font-semibold mb-2">Height (cm):</label>
            <input type="number" name="height" value="<?php echo $user['height']; ?>" class="border rounded px-2 py-1 w-1/2" required />
          </div>

          <div class="mb-4">
            <label class="block font-semibold mb-2">Weight (kg):</label>
            <input type="number" name="weight" value="<?php echo $user['weight']; ?>" class="border rounded px-2 py-1 w-1/2" required />
          </div>

          <div class="mb-4">
            <label class="block font-semibold mb-2">Classes Time:</label>
            <input type="text" name="time" class="border rounded px-2 py-1 w-1/2" required />
          </div>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-2">Select Facilities:</label>
          <div class="flex justify-evenly">
            <div>
              <label>
                <input type="checkbox" name="facility" value="Personal Training" class="mr-1" />
                Personal Training
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" name="facility" value="Customized Workout Plan" class="mr-1" />
                Customized Workout Plan
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" name="facility" value="Personalized Fitness Coaching" class="mr-1" />
                Personalized Fitness Coaching
              </label>
            </div>
          </div>
          <div class="flex justify-evenly mt-5 mr-14">
            <div>
              <label>
                <input type="checkbox" name="facility" value="Group Fitness Class" class="mr-1" />
                Group Fitness Class
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" name="facility" value="Progress and Feedback" class="mr-1" />
                Progress and Feedback
              </label>
            </div>
            <div>
              <label>
                <input type="checkbox" name="facility" value="Yoga And Meditation" class="mr-1" />
                Yoga And Meditation
              </label>
            </div>
          </div>


        </div>

        <div class="mb-4 flex flex-row space-x-4">
          <label class="block font-semibold mb-2">Fitness Goals:</label>
          <input type="text" name="goals" class="border rounded px-2 py-1 w-1/2" required />

          <label for="dob" class="block mb-1">Date:</label>
          <input type="date" name="date" id="date" class="w-1/2 p-2 border border-gray-300 rounded bg-white" required />
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
          <input type="submit" name="submit" value="Create Plan" class="bg-green-500 text-white font-medium rounded-md py-2 px-4 shadow-sm hover:bg-gray-500">

          <button onclick="handleHideForm()" class="ml-4 bg-red-500 text-white text-base font-medium rounded-md py-2 px-4 shadow-sm hover:bg-red-600">
            Close
          </button>
        </div>
      </form>
    </div>
  </div>
<?php } else { ?>
  <div class="flex justify-evenly py-7 mt-2">
    <a href="?page=login" class="bg-green-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded-lg">
      Please Login to Create Plan
    </a>
  </div>

<?php
}
?>


</body>

<script>
  // Function to toggle the visibility of the "moreContent" element.
  function toggleView() {
    var moreContent = document.getElementById("moreContent");
    moreContent.style.display =
      moreContent.style.display === "none" ? "block" : "none";
  }
  // Functions to show and hide the "planForm" element by adding or removing the "hidden" class.
  function handleShowForm() {
    document.getElementById("planForm").classList.remove("hidden");
  }

  function handleHideForm() {
    document.getElementById("planForm").classList.add("hidden");
  }
</script>