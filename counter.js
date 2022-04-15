// Counter
function decrement(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    if(value <= 1){
        btn.parentElement.parentElement.remove();
    }
    value--;
    target.value = value;
  }

  function increment(e) {
    const btn = e.target.parentNode.parentElement.querySelector(
      'button[data-action="decrement"]'
    );
    const target = btn.nextElementSibling;
    let value = Number(target.value);
    value++;
    target.value = value;
  }

  function remove(e){
      e.target.parentElement.remove();
  }

  const decrementButtons = document.querySelectorAll(
    `button[data-action="decrement"]`
  );

  const incrementButtons = document.querySelectorAll(
    `button[data-action="increment"]`
  );

  const removeButtons = document.querySelectorAll(
    `button[data-action="remove"]`
  );

  decrementButtons.forEach(btn => {
    btn.addEventListener("click", decrement);
  });


  incrementButtons.forEach(btn => {
    btn.addEventListener("click", increment);
  });

  removeButtons.forEach(btn => {
    btn.addEventListener("click", remove);
  });