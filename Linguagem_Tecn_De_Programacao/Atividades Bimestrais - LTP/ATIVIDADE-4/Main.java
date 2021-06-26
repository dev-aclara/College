import java.util.Scanner;

class Main {
  public static void main(String[] args) {

    Scanner in = new Scanner(System.in);

    System.out.println("-- Atividade 04 --");

    int qtLinha, qtCol, somaLinha=0, somaCol=0;

    //Ver quantidade de linhas 
    System.out.print("Digite a quantidade de linhas: ");
    qtLinha = in.nextInt();
    System.out.println("A matriz tera "+qtLinha +" linha[s].");

    System.out.println("");

    //Ver quantidade de colunas
    System.out.print("Digite a quantidade de colunas: ");
    qtCol = in.nextInt();
    System.out.println("A matriz tera "+qtCol +" coluna[s].");
    System.out.println();

    //Matriz declarada
    int matriz[][] = new int[qtLinha][qtCol];

    //Entrar com os valores de cada posicao
    for(int i=0; i<qtLinha; i++){ // percorre as linhas
      for(int j=0; j<qtCol; j++){ // percorre as colunas
        System.out.print("Digite um valor para a coordenada [" + i + ", " + j + "]: ");
        matriz[i][j] = in.nextInt();
      }  
    }

    //Exibir a matriz
    System.out.println("");
    System.out.println("--MATRIZ DECLARADA--");
    for(int i=0; i<qtLinha; i++){ // percorre as linhas
      for(int j=0; j<qtCol; j++){ // percorre as colunas
        System.out.printf("%5d ", matriz[i][j]);
      }
      System.out.println();
    }
    //Soma das linhas
    System.out.println();
    System.out.println("--SOMA DAS LINHAS--");
    for(int k=0; k<qtLinha; k++){ // percorre as linhas
      for(int l=0; l<qtCol; l++){ // percorre as colunas
        somaLinha += matriz[k][l];
      }
      System.out.printf("--> %d ", somaLinha);
      somaLinha=0;
    }
    System.out.println();
    
    //Soma das colunas
    System.out.println();
    System.out.println("--SOMA DAS COLUNAS--");
    for(int i=0; i<qtLinha; i++){ // percorre as linhas
      for(int j=0; j<qtCol; j++){ // percorre as colunas
        somaCol += matriz[j][i];
      }
      System.out.printf("--> %d ", somaCol);
      somaCol=0;
    }
  }
}