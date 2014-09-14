var now = moment(),
    
    blogMain = document.getElementById('theBlog'),
    
    
    posts = [
        {
            'date': '2014-09-06',
            'title': "Cat Fancy Editorial #3",
            'content': "In viverra tortor purr nullam consectetur, rip the couch vulputate orci turpis sunbathe bat. Faucibus suscipit nibh chase the red dot, accumsan shed everywhere give me fish faucibus pharetra tail flick tail flick. Purr sagittis chuf sleep in the sink libero enim ut, run adipiscing amet tristique vel."
        },
        {
            'date': '2014-09-01',
            'title': "Cat Fancy Exclusive Interview",
            'content': "Climb the curtains in viverra egestas quis nunc chase the red dot, elit climb the curtains ac non chuf sleep on your keyboard tortor. Eat the grass quis nunc libero puking attack, suscipit libero ac iaculis eat rutrum fluffy fur."
        },
        {
            'date': '2014-08-27',
            'title': "Cat Fancy Editorial #2",
            'content': "Climb the curtains tincidunt a give me fish aliquam ac suspendisse, puking sagittis et eat etiam. Pharetra rhoncus faucibus enim ut, iaculis vel faucibus scratched tempus non nibh shed everywhere. Claw attack suscipit sleep on your face kittens, I don't like that food justo neque purr neque puking."
        },
        {
            'date': '2014-08-24',
            'title': "Cat Fancy Editorial #1",
            'content': "Kitty ipsum dolor sit amet, give me fish iaculis orci turpis stuck in a tree, pellentesque scratched elit libero tincidunt a rutrum. Purr leap sleep on your keyboard suscipit sleep on your keyboard, hairball purr I don't like that food I don't like that food sleep in the sink biting enim ut. Shed everywhere tristique zzz nullam neque, toss the mousie tempus egestas rutrum et sunbathe eat the grass."
        }
    ];

posts.forEach(function (post, index) {
    var postDiv = document.createElement('div');
    postDiv.setAttribute('class', 'blogPosts');
    
    postDiv.innerHTML += "<h2>" + posts[index].title + "</h2>"
                      + "<p>" + posts[index].content + "</p>"
                      + "<p><em>" + moment(posts[index].date,"YYYY-MM-DD").fromNow() + "</em></p>";
    blogMain.appendChild(postDiv);

});

