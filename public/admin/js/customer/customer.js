

//generate random string for customer's id
function generateRandomCode() {
    var length = 8;
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var result = 'KH_';

    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    document.getElementById('customer_id').value = result;
  }

  var citis = document.getElementById("city");
  var districts = document.getElementById("district");
  var wards = document.getElementById("ward");
  var Parameter = {
    url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
    method: "GET", 
    responseType: "application/json", 
  };
  var promise = axios(Parameter);
  promise.then(function (result) {
    renderCity(result.data);
  });

  function renderCity(data) {
    for (const x of data) {
      citis.options[citis.options.length] = new Option(x.Name, x.Id);
    }
    citis.onchange = function () {
      district.length = 1;
      ward.length = 1;
      if(this.value != ""){
        const result = data.filter(n => n.Id === this.value);

        for (const k of result[0].Districts) {
          district.options[district.options.length] = new Option(k.Name, k.Id);
        }
      }
    };
    district.onchange = function () {
      ward.length = 1;
      const dataCity = data.filter((n) => n.Id === citis.value);
      if (this.value != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

        for (const w of dataWards) {
          wards.options[wards.options.length] = new Option(w.Name, w.Id);
        }
      }
    };
  }

  // Catch events when the value of select changes
  document.getElementById('city').addEventListener('change', updateSelectedText);
  document.getElementById('district').addEventListener('change', updateSelectedText);
  document.getElementById('ward').addEventListener('change', updateSelectedText);

    // Function to update the value of the hidden input field
    function updateSelectedText() {
        var citySelectedIndex = document.getElementById('city').selectedIndex;
        var districtSelectedIndex = document.getElementById('district').selectedIndex;
        var wardSelectedIndex = document.getElementById('ward').selectedIndex;

        var citySelectedText = document.getElementById('city').options[citySelectedIndex].text;
        var districtSelectedText = document.getElementById('district').options[districtSelectedIndex].text;
        var wardSelectedText = document.getElementById('ward').options[wardSelectedIndex].text;

        var address = wardSelectedText + ', ' + districtSelectedText + ', ' + citySelectedText;

        document.getElementById('address').value = address;
    }
