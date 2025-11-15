document.addEventListener("DOMContentLoaded", function () {
  const seconds = document.querySelector(".seconds .number h2");
  const minutes = document.querySelector(".minutes .number h2");
  const hours = document.querySelector(".hours .number h2");
  const days = document.querySelector(".days .number h2");

  let secValue = 59,
    minValue = 59,
    hourValue = 5,
    dayValue = 5;

  const timeFunction = setInterval(() => {
    secValue--;

    if (secValue === 0) {
      minValue--;
      secValue = 59;
    }
    if (minValue === 0) {
      hourValue--;
      minValue = 59;
    }
    if (hourValue === 0) {
      dayValue--;
      hourValue = 23;
    }

    if (dayValue === 0) {
      clearInterval(timeFunction);
    }

    seconds.textContent = secValue < 10 ? `0${secValue}` : secValue;
    minutes.textContent = minValue < 10 ? `0${minValue}` : minValue;
    hours.textContent = hourValue < 10 ? `0${hourValue}` : hourValue;
    days.textContent = dayValue < 10 ? `0${dayValue}` : dayValue;
  }, 1000); // 1000ms = 1s
});