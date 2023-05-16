function jsTest() {
  var text = "javescript test";
  return text;
}

function changeBackgroundDefault() {
  document.body.style.background = 'url(images/thing.png)';
}

 function changeBackgroundDark() {
   document.body.style.background = 'url(images/BlackBackground.png)';
}

 function changeBackgroundWhite() {
   document.body.style.background = 'url(images/WhiteBackground.png)';
}

function changeBackgroundPepe() {
  document.body.style.background = 'url(images/PepeBackground.jpg)';
}




// will want to switch to pure CSS after
  function openPopupLogin() {
    // Set the URL of the popup window
    var popupUrl = "./login.php";

    // Set the width and height of the popup window
    var popupWidth = 400;
    var popupHeight = 300;

    // Calculate the position of the popup window
    var popupLeft = window.screen.width / 2 - popupWidth / 2;
    var popupTop = window.screen.height / 2 - popupHeight / 2;

    // Open the popup window with the specified settings
    window.open(popupUrl, "PopupWindow", "width=" + popupWidth + ",height=" + popupHeight + ",left=" + popupLeft + ",top=" + popupTop);
  }

// will want to switch to pure CSS after
  function openPopupRegister() {
    // Set the URL of the popup window
    var popupUrl = "./register.php";

    // Set the width and height of the popup window
    var popupWidth = 400;
    var popupHeight = 300;

    // Calculate the position of the popup window
    var popupLeft = window.screen.width / 2 - popupWidth / 2;
    var popupTop = window.screen.height / 2 - popupHeight / 2;

    // Open the popup window with the specified settings
    window.open(popupUrl, "PopupWindow", "width=" + popupWidth + ",height=" + popupHeight + ",left=" + popupLeft + ",top=" + popupTop);
  }

  function loadThread(threadID) {
    // Clear the thread container
    var threadContainer = document.querySelector('.threadcontainer');
    threadContainer.innerHTML = '';

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        threadContainer.innerHTML = this.responseText;
      }
    };
    threadContainer.innerHTML = threadID;
    xhr.open("GET", "../php/functions.php?function=displayThreadContents&id=" + threadID, true);
    xhr.send();
  }


  function postThreadPopup() {
    const popupButton = document.getElementById("popup-button");
    const popupContainer = document.getElementById("thread-popup-container");
    const closeButton = document.getElementById("thread-close-button");

    // display popup
    popupContainer.style.display = "block";

    // close popup when close button is clicked
    closeButton.addEventListener("click", () => {
      popupContainer.style.display = "none";
    });

    // close popup when user clicks outside of popup
    popupContainer.addEventListener("click", (event) => {
      if (event.target === popupContainer) {
        popupContainer.style.display = "none";
      }
    });
  }


  function userProfilePopup() {
    const popupButton = document.getElementById("popup-link");
    const popupContainer = document.getElementById("userprofile-popup-container");
    const closeButton = document.getElementById("userprofile-close-button");

    // display popup
    popupContainer.style.display = "block";

    // close popup when close button is clicked
    closeButton.addEventListener("click", () => {
      popupContainer.style.display = "none";
    });

    // close popup when user clicks outside of popup
    popupContainer.addEventListener("click", (event) => {
      if (event.target === popupContainer) {
        popupContainer.style.display = "none";
      }
    });
  }


  function registerPopup() {
    const popupButton = document.getElementById("registerButton");
    const popupContainer = document.getElementById("register-popup-container");
    const closeButton = document.getElementById("register-close-button");

    // display popup
    popupContainer.style.display = "block";

    // close popup when close button is clicked
    closeButton.addEventListener("click", () => {
      popupContainer.style.display = "none";
    });

    // close popup when user clicks outside of popup
    popupContainer.addEventListener("click", (event) => {
      if (event.target === popupContainer) {
        popupContainer.style.display = "none";
      }
    });
  }


  function loginPopup() {
    //const popupButton = document.getElementById("loginButton");
    const popupContainer = document.getElementById("login-popup-container");
    const closeButton = document.getElementById("login-close-button");

    // display popup
    popupContainer.style.display = "block";

    // close popup when close button is clicked
    closeButton.addEventListener("click", () => {
      popupContainer.style.display = "none";
    });

    // close popup when user clicks outside of popup
    popupContainer.addEventListener("click", (event) => {
      if (event.target === popupContainer) {
        popupContainer.style.display = "none";
      }
    });
  }
