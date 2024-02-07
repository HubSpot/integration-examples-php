document.getElementById('copyBtn').onclick = async () => {
  let text = document.getElementById('copyText').textContent;
  await navigator.clipboard.writeText(text);

  alert('Copied');
};
