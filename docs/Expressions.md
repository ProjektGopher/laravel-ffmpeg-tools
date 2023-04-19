# Expression Helpers
When writing _long_ and **complicated** evaluated expressions, it can be easy to lose track of extra/missing perentheses, missing parameters, or unescaped commas. Especially when the whole expression _has_ to be on one line without any linebreaks or whitespace.

The `Expr` class can help with this. If your expression is short enough this might be overkill, but for longer expressions this can really help with these issues. The named arguments aren't strictly necessary, but can help keep things more obviously in-line with the provided documentation which has been ported directly from the FFMpeg documentation.

> **note** Currently only the `eq`, `gt`, `if`, and `lt`, have been implemented.

## Example Diff
```diff
+ use ProjektGopher\FFMpegTools\Utils\Expr;

....

-   return "if(eq(({$time})\\,0)\\,0\\,if(eq(({$time})\\,1)\\,1\\,pow(2\\,-10*({$time}))*sin((({$time})*10-0.75)*{$c4})+1))";
+   return Expr::if(
+       x: Expr::eq($time, '0'),
+       y: '0',
+       z: Expr::if(
+           x: Expr::eq($time, '1'),
+           y: '1',
+           z: "pow(2\\,-10*({$time}))*sin((({$time})*10-0.75)*{$c4})+1",
+       ),
+   );
```
