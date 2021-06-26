package Exercicio4;

import java.util.Arrays;
import java.util.Random;

public class Ex04 {

    public static void main(String[] args) {

        int numeros[] = new int[100];

        for (int i = 0; i<numeros.length; i++){
            numeros[i] = new Random().nextInt(60);
        }

       System.out.println((Arrays.toString(numeros)));

       int media=0, soma=0;

       for(int i=0; i<numeros.length; i++)
       {
           soma = soma + numeros[i];
       }
       System.out.println(soma);

       media = (soma/numeros.length);
    
       System.out.println("Media "+ (media));
       System.out.println("Menor que media");
       for (int i = 0; i<numeros.length; i++){
           if(numeros[i] < media)
            {
               System.out.println(""+numeros[i]);
            }
       }
       System.out.println("Maior igual a media");
       for (int i = 0; i<numeros.length; i++){
           if(numeros[i] >= media)
           {
               System.out.println(""+numeros[i]);
           }
       }
    }
}
       
    
    


