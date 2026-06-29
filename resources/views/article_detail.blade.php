<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title"></title>
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
            width: 98% !important
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
                        document.getElementById('title').innerText = article.title;
                        document.getElementById('content').innerHTML = article.content;
                        adjustFontSize(urlParams.get('version'));
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
