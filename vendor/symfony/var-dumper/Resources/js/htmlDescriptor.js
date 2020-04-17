document.addEventListener('DOMContentLoaded', function() {
  let prev = null;
  Array.from(document.getElementsByTagName('chapter')).reverse().forEach(function (chapter) {
    const dedupId = chapter.dataset.dedupId;
    if (dedupId === prev) {
      chapter.getElementsByTagName('header')[0].classList.add('hidden');
    }
    prev = dedupId;
  });
});
