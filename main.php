<?php
class Circulo{
  public $raio;

  public function __construct($raio){
    $this->raio = $raio;
  }

  public function calcularArea(){
    return 3.14 * $this->raio * $this->raio;
  }

  public function calcularCircuferencia(){
    return 2 * 3.14 * $this->raio;
  }
}

$circulo = new Circulo(8);
echo $circulo->calcularArea() . "\n";
echo $circulo->calcularCircuferencia() . "\n";
//exc1
class ContaBancaria{
  public $numeroConta;
  public $nomeTitular;
  public $saldoConta;

  public function __construct($numeroConta, $nomeTitular, $saldoConta = 0){
    $this->numeroConta = $numeroConta;
    $this->nomeTitular = $nomeTitular;
    $this->saldoConta = $saldoConta;
  }

  public function depositarValor($valor){
    if($valor > 0){
      $this->saldoConta += $valor;
      return "Depósito efetuado com sucesso!";
    }else{
      return "Não é possível depostiar um valor negativo!";
    }
  }

  public function sacarValor($valor){
    if ($this->saldoConta < $valor){
      return "Seu saldo é isuficiente para realizar este saque!";
    }else{
      $this->saldoConta -= $valor;
      return "Saque efetuado com sucesso!";
    }
  }

  public function consultarSaldo(){
    return $this->saldoConta;
  }
}

$ana = new ContaBancaria("00001-A", "Ana", 6000);
echo $ana->sacarValor(650) . "\n";
echo $ana->depositarValor(1000) . "\n";
echo $ana->consultarSaldo() . "\n";
echo $ana->depositarValor(-100) . "\n";
echo $ana->sacarValor(100000) . "\n";
//exc2
class Funcionario {
    public $nome;
    public $cargo;
    public $salario;

    public function __construct($nome, $cargo, $salario) {
        if ($salario < 0) {
            throw new Exception("Salário não pode ser negativo");
        }
        $this->nome = $nome;
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    public function calcularSalarioAnual() {
        return $this->salario * 12;
    }

    public function aplicarAumento($percentual) {
        if ($percentual < 0) {
            throw new Exception("Percentual não pode ser negativo");
        }
        $this->salario += $this->salario * ($percentual / 100);
    }
}

try {

    $func = new Funcionario("Carlos Silva", "Analista de Sistemas", 4500.00);
    echo "Nome: " . $func->nome . "\n";
    echo "Cargo: " . $func->cargo . "\n";
    echo "Salário mensal: R$ " . number_format($func->salario, 2, ',', '.') . "\n";
    echo "Salário anual: R$ " . number_format($func->calcularSalarioAnual(), 2, ',', '.') . "\n";
    $func->aplicarAumento(15);
    echo "Salário após 15% de aumento: R$ " . number_format($func->salario, 2, ',', '.') . "\n";
    echo "Novo salário anual: R$ " . number_format($func->calcularSalarioAnual(), 2, ',', '.') . "\n";

    try {
        $funcInvalido = new Funcionario("João", "Estagiário", -1000);
    } catch (Exception $e) {
        echo "Validação (salário negativo): " . $e->getMessage() . "\n";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("-", 50) . "\n\n";
//exc3
class Produto {
    public $nome;
    public $preco;
    public $quantidade;

    public function __construct($nome, $preco, $quantidade) {
        if ($preco < 0) {
            throw new Exception("Preço não pode ser negativo");
        }
        if ($quantidade < 0) {
            throw new Exception("Quantidade não pode ser negativa");
        }
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function atualizarPreco($novoPreco) {
        if ($novoPreco < 0) {
            throw new Exception("Preço não pode ser negativo");
        }
        $this->preco = $novoPreco;
    }

    public function aplicarDesconto($percentual) {
        if ($percentual < 0) {
            throw new Exception("Percentual não pode ser negativo");
        }
        $this->preco -= $this->preco * ($percentual / 100);
        if ($this->preco < 0) {
            $this->preco = 0;
        }
    }

    public function adicionarEstoque($quantidade) {
        if ($quantidade < 0) {
            throw new Exception("Quantidade não pode ser negativa");
        }
        $this->quantidade += $quantidade;
    }

    public function removerEstoque($quantidade) {
        if ($quantidade < 0) {
            throw new Exception("Quantidade não pode ser negativa");
        }
        if ($this->quantidade >= $quantidade) {
            $this->quantidade -= $quantidade;
        }
    }
}

try {

    $prod = new Produto("Smartphone Galaxy S23", 3500.00, 25);
    echo "Produto: " . $prod->nome . "\n";
    echo "Preço unitário: R$ " . number_format($prod->preco, 2, ',', '.') . "\n";
    echo "Quantidade em estoque: " . $prod->quantidade . "\n";

    $prod->aplicarDesconto(10);
    echo "Preço após 10% de desconto: R$ " . number_format($prod->preco, 2, ',', '.') . "\n";

    $prod->adicionarEstoque(10);
    echo "Estoque após adicionar 10 unidades: " . $prod->quantidade . "\n";

    $prod->removerEstoque(5);
    echo "Estoque após remover 5 unidades: " . $prod->quantidade . "\n";

    $prod->removerEstoque(100);
    echo "Tentativa de remover 100 unidades (estoque inalterado): " . $prod->quantidade . "\n";

    try {
        $prodInvalido = new Produto("Teste", -50, 10);
    } catch (Exception $e) {
        echo "Validação (preço negativo): " . $e->getMessage() . "\n";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("-", 50) . "\n\n";
//exc4
class ConsultaMedica {
    public $dataHora;
    public $paciente;
    public $status;
    public static $todasConsultas = [];

    public function __construct($dataHora, $paciente) {
        if ($this->existeConflito($dataHora)) {
            throw new Exception("Já existe uma consulta agendada nesse horário");
        }
        $this->dataHora = $dataHora;
        $this->paciente = $paciente;
        $this->status = "Agendada";
        self::$todasConsultas[] = $this;
    }

    public function cancelar() {
        foreach (self::$todasConsultas as $key => $consulta) {
            if ($consulta === $this) {
                unset(self::$todasConsultas[$key]);
                break;
            }
        }
        self::$todasConsultas = array_values(self::$todasConsultas);
        $this->status = "Cancelada";
    }

    public function reagendar($novaDataHora) {
        if ($this->existeConflito($novaDataHora)) {
            throw new Exception("Já existe uma consulta agendada nesse horário");
        }
        $this->dataHora = $novaDataHora;
        $this->status = "Agendada";
    }

    private function existeConflito($dataHora) {
        foreach (self::$todasConsultas as $consulta) {
            if ($consulta !== $this && $consulta->dataHora == $dataHora) {
                return true;
            }
        }
        return false;
    }
}

try {
    $consulta1 = new ConsultaMedica("2026-07-15 09:00:00", "Ana Paula");
    echo "Paciente: " . $consulta1->paciente . "\n";
    echo "Data/Hora: " . $consulta1->dataHora . "\n";
    echo "Status: " . $consulta1->status . "\n";

    try {
        $consultaConflito = new ConsultaMedica("2026-07-15 09:00:00", "João Pedro");
    } catch (Exception $e) {
        echo "Validação (conflito de horário): " . $e->getMessage() . "\n";
    }

    $consulta1->cancelar();
    echo "Status após cancelar: " . $consulta1->status . "\n";

    $consulta1->reagendar("2026-07-16 14:30:00");
    echo "Nova data/hora: " . $consulta1->dataHora . "\n";
    echo "Status após reagendar: " . $consulta1->status . "\n";

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("-", 50) . "\n\n";
//exc5
class Fatura {
    public $numeroFatura;
    public $valorOriginal;
    public $valorFinal;
    public $status;

    public function __construct($numeroFatura, $valorOriginal) {
        if ($valorOriginal < 0) {
            throw new Exception("Valor não pode ser negativo");
        }
        $this->numeroFatura = $numeroFatura;
        $this->valorOriginal = $valorOriginal;
        $this->valorFinal = $valorOriginal;
        $this->status = "Aberta";
    }

    public function aplicarDesconto($percentual) {
        if ($percentual < 0 || $percentual > 100) {
            throw new Exception("Percentual deve estar entre 0 e 100");
        }
        $desconto = $this->valorOriginal * ($percentual / 100);
        $this->valorFinal = $this->valorOriginal - $desconto;
        if ($this->valorFinal < 0) {
            $this->valorFinal = 0;
        }
    }

    public function marcarPaga() {
        $this->status = "Paga";
    }
}

try {
    $fatura = new Fatura("FAT-2026-001", 1500.00);
    echo "Número da fatura: " . $fatura->numeroFatura . "\n";
    echo "Valor original: R$ " . number_format($fatura->valorOriginal, 2, ',', '.') . "\n";
    echo "Valor final: R$ " . number_format($fatura->valorFinal, 2, ',', '.') . "\n";
    echo "Status: " . $fatura->status . "\n";

    $fatura->aplicarDesconto(25);
    echo "Valor final após 25% de desconto: R$ " . number_format($fatura->valorFinal, 2, ',', '.') . "\n";

    try {
        $fatura->aplicarDesconto(150);
    } catch (Exception $e) {
        echo "Validação (desconto > 100%): " . $e->getMessage() . "\n";
    }

    $fatura->marcarPaga();
    echo "Status após pagamento: " . $fatura->status . "\n";

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat("-", 50) . "\n\n";
//exc6
class PedidoVenda {
    public $total;

    public function __construct($total) {
        if ($total < 0) {
            throw new Exception("Total não pode ser negativo");
        }
        $this->total = $total;
    }
}

class RelatorioVendas {
    public function __construct() {
    }

    public function gerarTotal($listaPedidos) {
        $soma = 0;
        if (empty($listaPedidos)) {
            return 0;
        }
        foreach ($listaPedidos as $pedido) {
            $soma += $pedido->total;
        }
        return $soma;
    }
}

try {
    $pedidos = [
        new PedidoVenda(125.50),
        new PedidoVenda(89.90),
        new PedidoVenda(250.00),
        new PedidoVenda(45.30),
        new PedidoVenda(320.75)
    ];

    echo "Lista de pedidos:\n";
    foreach ($pedidos as $i => $pedido) {
        echo "  Pedido " . ($i+1) . ": R$ " . number_format($pedido->total, 2, ',', '.') . "\n";
    }

    $relatorio = new RelatorioVendas();
    $totalVendas = $relatorio->gerarTotal($pedidos);
    echo "Total de vendas do período: R$ " . number_format($totalVendas, 2, ',', '.') . "\n";

    $pedidosVazios = [];
    $totalVazio = $relatorio->gerarTotal($pedidosVazios);
    echo "Total com lista vazia: R$ " . number_format($totalVazio, 2, ',', '.') . "\n";

    try {
        $pedidoInvalido = new PedidoVenda(-100);
    } catch (Exception $e) {
        echo "Validação (total negativo): " . $e->getMessage() . "\n";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

?>