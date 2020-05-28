var str = "The bad in corn, stays mainly in the plain";

var newstr = str.split(/[,\s/]+/)

var bad_words = ['bad', 'corn', 'stays'];

const intersection = newstr.filter(element => bad_words.includes(element));
// console.log(intersection.length);

if(intersection.length > 0){
    console.log("Choose your words Carefully");
}else{
    return 0;
}


// for(i in bad_words){
    
//     var pattern1 = '/' + bad_words[i].trim() + '/i';
//     // console.log(pattern1)
    
//     // console.log(str.match(pattern1))
//     // console.log(str.match(bad_words[i]));

// }
