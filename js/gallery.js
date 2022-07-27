function vote() {
  var voteBtn = document.getElementsByClassName("vote")[0];
  var unvoteBtn = document.getElementsByClassName("unvote")[0];

  if (voteBtn.style.display != "none") {
    voteBtn.style.display = "none";
    unvoteBtn.style.display = "block";
  } else {
    voteBtn.style.display = "block";
    unvoteBtn.style.display = "none";
  }
}

function closeModal() {
  var modal = document.getElementById("myModal");
  document.getElementById("myYoutubePlayer").src =
    document.getElementById("myYoutubePlayer").src;
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    this.closeModal();
  }
};

/* global AFRAME */
AFRAME.registerComponent("highlight", {
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
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    console.log(evt.currentTarget.id);
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
