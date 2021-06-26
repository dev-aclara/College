/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package atividade.pkg3;

import java.util.Scanner;
/**
 *
 * 
 */
public class Atividade3 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        /**
         * Desenvolva um algoritmo, em Java, onde o usuário entre com uma determinada quantidade de números que serão lidos.
         * Após a leitura de todos os valores e o armazenamento em um vetor, apresentar qual o maior e qual o menor valor e
            seus respectivos índices no vetor.
         */
        
        Scanner scan = new Scanner(System.in);
        int num,i,pMaior=0,pMenor=0,maior=0,menor=999999;
        
        System.out.println("Digite quantos numeros serao lidos: ");
        num = scan.nextInt();
        int[] vetor = new int[num];
        
        for(i=0;i<num;i++)
        {
            System.out.println("Digite o valor da posicao "+i+" :");
            vetor[i]=scan.nextInt();
        }
        for(i=0;i<num;i++)
        {
            if(vetor[i]>maior)
            {
                maior=vetor[i];
                pMaior=i;
            }
            if(vetor[i]<menor)
            {
                menor=vetor[i];
                pMenor=i;
            }
        }
        System.out.println("\nO maior valor do vetor e "+maior+" sua posicao "+pMaior);
        System.out.println("\nO menor valor do vetor e "+menor+" sua posicao "+pMenor);
        
    }
    
}
