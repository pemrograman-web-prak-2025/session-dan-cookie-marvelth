document.addEventListener('DOMContentLoaded', function(){
  function formatTime(s){
    const m = Math.floor(s/60).toString().padStart(2,'0');
    const sec = (s%60).toString().padStart(2,'0');
    return `${m}:${sec}`;
  }

  const startButtons = document.querySelectorAll('.start-btn');
  startButtons.forEach(btn => {
    btn.addEventListener('click', function(){
      const id = this.dataset.id;
      const minutes = parseInt(this.dataset.minutes,10) || 25;
      const display = document.getElementById('timer-'+id);
      if (!display) return;
      this.disabled = true;
      this.textContent = 'Running...';
      let remaining = minutes * 60;
      display.textContent = formatTime(remaining);

      const interval = setInterval(()=>{
        remaining -= 1;
        display.textContent = formatTime(remaining);
        if (remaining <= 0){
          clearInterval(interval);
          this.textContent = 'Completed';
          fetch(`/timers/${id}/complete`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: '{}'
          }).then(()=>{
            display.textContent = '00:00';
            this.classList.remove('bg-green-500');
            this.classList.add('bg-gray-400');
          }).catch(()=>{});
        }
      }, 1000);
    });
  });

  function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

  // Baca cookie
  function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
  }
});
