package Exercicio05;
import java.util.Scanner;
import java.util.Arrays;


public class Ex05 {
    

    public static void main(String[] args) {

        Scanner in = new Scanner (System.in);

        float soma = 0, media = 0, ord=0;

        System.out.println("Digite a quantidade de valores voce deseja informar:");
        int numero = in.nextInt();

        System.out.println("Digite os valores: ");

        float []valor = new float[numero];

        for(int i = 0; i < numero; i ++) {

            valor[i] = in.nextFloat();

        }

        soma = 0;

        for(int i = 0; i < numero; i ++) {

            soma = soma + valor[i];

        }

        media = soma/numero;

        
        System.out.println("Media: "+ media);   

          // Ordena o vetor;
          Arrays.sort(valor);

          


    }
    
}
