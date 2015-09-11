class Fibonacci {
    private $x = 1;
    private $y = 1;
    private $z = 0;

    function __contruct($a, $b, $c){
        $this->x = $a;
        $this->b = $b;
        $this->z = $c;
    }

    function generateFibonacci(){
        while ($this->z < $1000){
            $this->z = $x + $y;
            echo $z . ' ';
            $this->x = $y;
            $this->y = $z;
        }
    }
}


$fibo = new Fibonacci(1, 1, 0);
$fibo->generateFibonacci();

