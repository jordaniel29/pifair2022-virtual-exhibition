function closeModalLogo(sponsorId) {
  var teamModal = document.getElementById("modal-logo-" + sponsorId);
  teamModal.style.display = "none";
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

function closeModalVideo(sponsorId) {
  var ytId = "youtube-" + sponsorId;
  document.getElementById(ytId).src = document.getElementById(ytId).src;
  var teamModal = document.getElementById("modal-video-" + sponsorId);
  teamModal.style.display = "none";
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

function closeModalPoster(posterId) {
  var teamModal = document.getElementById("modal-poster-" + posterId);
  teamModal.style.display = "none";
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
}

/* highliht AFRAME component */
AFRAME.registerComponent("highlight-exhibition", {
  init: function () {
    var buttonEls = (this.buttonEls = this.el.querySelectorAll(".menu-button"));
    var backgroundEl = document.querySelector("#background");
    this.onClick = this.onClick.bind(this);
    this.onMouseEnter = this.onMouseEnter.bind(this);
    this.onMouseLeave = this.onMouseLeave.bind(this);
    for (var i = 0; i < buttonEls.length; ++i) {
      buttonEls[i].addEventListener("mouseenter", this.onMouseEnter);
      buttonEls[i].addEventListener("mouseleave", this.onMouseLeave);
      buttonEls[i].addEventListener("click", this.onClick);
    }
  },

  onClick: function (evt) {
    var id = "modal-" + evt.currentTarget.id;
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    var sponsorModal = document.getElementById(id);
    sponsorModal.style.display = "block";
  },

  onMouseEnter: function (evt) {
    var buttonEls = this.buttonEls;
    evt.target.setAttribute("material", "color", "#046de7");
    for (var i = 0; i < buttonEls.length; ++i) {
      if (evt.target === buttonEls[i]) {
        continue;
      }
      buttonEls[i].setAttribute("material", "color", "white");
    }
  },

  onMouseLeave: function (evt) {
    if (this.el.is("clicked")) {
      return;
    }
    evt.target.setAttribute("material", "color", "white");
  },
});

/* limit-distance for camera component */
AFRAME.registerComponent("limit-my-distance-exhibition", {
  init: function () {
    // do nothing
  },

  tick: function () {
    // limit Z
    if (this.el.object3D.position.z > 12.7) {
      this.el.object3D.position.z = 12.7;
    }
    if (this.el.object3D.position.z < -12.7) {
      this.el.object3D.position.z = -12.7;
    }

    // limit X
    if (this.el.object3D.position.x > 9.2) {
      this.el.object3D.position.x = 9.2;
    }
    if (this.el.object3D.position.x < -14.7) {
      this.el.object3D.position.x = -14.7;
    }
  },
});
