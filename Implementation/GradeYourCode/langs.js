
var LANGS = {
    "C/C++": [7, "text/x-c++src"],
    "C#": [10, "text/x-csharp"],
    "Java": [8, "text/x-java"],
   "Python": [0, "text/x-python"]
    };


var Codes = {
    "Java": "/* package whatever; // don't place package name! */\n\nimport java.io.*;\n\nclass myCode\n{\n\tpublic static void main (String[] args) throws java.lang.Exception\n\t{\n\t\t\n\t\tSystem.out.println(\"Hello\");\n\t}\n}",
    "C/C++": "#include <iostream>\nusing namespace std;\n\nint main() {\n\tcout<<\"Hello\";\n\treturn 0;\n}",
    "C#": "using System;\n\npublic class Test\n{\n\tpublic static void Main()\n\t{\n\t\t\tConsole.WriteLine(\"Hello\");\n\t}\n}",
    "Python": "print \"Hello\"",
};

var ErrorPatterns = {
    
    "Java": [0,":",/\d+: error/g],
    "C/C++": [0,":",/\d+:\d/g],
    "C#": [0,",",/(\d+,\d)/g],
    "Python": [5,",",/line \d+,/g]
};


