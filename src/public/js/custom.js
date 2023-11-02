document.addEventListener('DOMContentLoaded', function() {
    // 投稿全体のクリックイベントを追加
    document.querySelectorAll('.post-container').forEach(function(container) {
        container.addEventListener('click', function(event) {
            window.location.href = event.currentTarget.getAttribute('data-url');
        });
    });

    // ハッシュタグやその他のリンクのクリックイベントを停止
    document.querySelectorAll('.post-container a').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
});
