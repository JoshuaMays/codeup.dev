var now = moment(),
    
    blogPostOneTitle = document.getElementById("blog-post-title-1"),
    blogPostOne = document.getElementById("blog-post-content-1"),
    blogPostOneDate = document.getElementById("blog-post-date-1"),
    
    blogPostTwoTitle = document.getElementById("blog-post-title-2"),
    blogPostTwo = document.getElementById("blog-post-content-2"),
    blogPostTwoDate = document.getElementById("blog-post-date-2"),
    
    blogPostThreeTitle = document.getElementById("blog-post-title-3"),
    blogPostThree = document.getElementById("blog-post-content-3"),
    blogPostThreeDate = document.getElementById("blog-post-date-3"),
    
    blogPostFourTitle = document.getElementById("blog-post-title-4"),
    blogPostFour = document.getElementById("blog-post-content-4"),
    blogPostFourDate = document.getElementById("blog-post-date-4"),
    
    posts = [
        {
            'date': '2014-08-24',
            'title': "Cat Fancy Editorial #1",
            'content': "Kitty ipsum dolor sit amet, give me fish iaculis orci turpis stuck in a tree, pellentesque scratched elit libero tincidunt a rutrum. Purr leap sleep on your keyboard suscipit sleep on your keyboard, hairball purr I don't like that food I don't like that food sleep in the sink biting enim ut. Shed everywhere tristique zzz nullam neque, toss the mousie tempus egestas rutrum et sunbathe eat the grass."
        },
        {
            'date': '2014-08-27',
            'title': "Cat Fancy Editorial #2",
            'content': "Climb the curtains tincidunt a give me fish aliquam ac suspendisse, puking sagittis et eat etiam. Pharetra rhoncus faucibus enim ut, iaculis vel faucibus scratched tempus non nibh shed everywhere. Claw attack suscipit sleep on your face kittens, I don't like that food justo neque purr neque puking."
        },
        {
            'date': '2014-09-01',
            'title': "Cat Fancy Exclusive Interview",
            'content': "Climb the curtains in viverra egestas quis nunc chase the red dot, elit climb the curtains ac non chuf sleep on your keyboard tortor. Eat the grass quis nunc libero puking attack, suscipit libero ac iaculis eat rutrum fluffy fur."
        },
        {
            'date': '2014-09-06',
            'title': "Cat Fancy Editorial #3",
            'content': "In viverra tortor purr nullam consectetur, rip the couch vulputate orci turpis sunbathe bat. Faucibus suscipit nibh chase the red dot, accumsan shed everywhere give me fish faucibus pharetra tail flick tail flick. Purr sagittis chuf sleep in the sink libero enim ut, run adipiscing amet tristique vel."
        }
];


blogPostOneTitle.innerText = posts[0].title;
blogPostOne.innerText = posts[0].content;
blogPostOneDate.innerText = moment(posts[0].date,"YYYY-MM-DD").fromNow();

blogPostTwoTitle.innerText = posts[1].title;
blogPostTwo.innerText = posts[1].content;
blogPostTwoDate.innerText = moment(posts[1].date,"YYYY-MM-DD").fromNow();

blogPostThreeTitle.innerText = posts[2].title;
blogPostThree.innerText = posts[2].content;
blogPostThreeDate.innerText = moment(posts[2].date,"YYYY-MM-DD").fromNow();

blogPostFourTitle.innerText = posts[3].title;
blogPostFour.innerText = posts[3].content;
blogPostFourDate.innerText = moment(posts[3].date,"YYYY-MM-DD").fromNow();
