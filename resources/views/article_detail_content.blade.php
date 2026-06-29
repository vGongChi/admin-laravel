<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章详情</title>
    <style>
        #title {
            text-align: center !important;
            width: 98%;
            margin: 0 auto !important;
            font-size: 18px !important;
            font-weight: bold !important;
        }
        #content {
            width: 98% !important;
            margin: 0 auto !important;
            font-size: 16px; /* Default font size */
        }
        #content img {
            display: block !important;
            margin: 0 auto !important;
            width: 98% !important;
            /* Add a placeholder for lazy loading */
            opacity: 0;
            transition: opacity 0.3s;
        }
        #content img.lazy-loaded {
            opacity: 1;
        }
        .large-font {
            font-size: 22px !important; /* Increase by 6 */
        }

        .large-font span{
            font-size: 22px !important; /* Increase by 6 */
        }
    </style>
</head>
<body>
    <div id="article-detail">
        <div id="content"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');

            function lazyLoadImages() {
                const images = document.querySelectorAll('#content img[data-src]');
                const config = {
                    rootMargin: '0px 0px 50px 0px',
                    threshold: 0
                };

                let observer = new IntersectionObserver(function(entries, self) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            let img = entry.target;
                            img.src = img.getAttribute('data-src');
                            img.removeAttribute('data-src');
                            img.classList.add('lazy-loaded');
                            self.unobserve(img);
                        }
                    });
                }, config);

                images.forEach(image => {
                    observer.observe(image);
                });
            }

            function adjustFontSize(version) {
                console.log('Version:', version);
                if (version == '1') {
                    $('#content').addClass('large-font');
                }
            }

            if (query) {
                fetch(`https://www.sjquanquan.com/api/article/detail?query=${query}`, {
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Methods': 'GET, POST, OPTIONS, PUT, DELETE',
                        'Access-Control-Allow-Headers': 'Content-Type, X-Auth-Token, Origin, Authorization'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === 0) {
                        const article = data.data;
                        const contentElement = document.getElementById('content');
                        contentElement.innerHTML = article.content;

                        // Replace src with data-src for lazy loading
                        const images = contentElement.querySelectorAll('img');
                        images.forEach(img => {
                            img.setAttribute('data-src', img.src);
                            img.removeAttribute('src');
                        });

                        adjustFontSize(urlParams.get('version'));
                        lazyLoadImages();
                    } else {
                        alert('Article not found');
                    }
                })
                .catch(error => {
                    console.error('Error fetching article:', error);
                    alert('Error fetching article');
                });
            } else {
                alert('Query parameter is required');
            }
        });
    </script>
</body>
</html>
