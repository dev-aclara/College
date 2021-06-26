package Exercicio1;

// Considerando o trecho que código apresentado abaixo, qual seria o valor de saída obtido

public class Ex02 {

    public static void main(String[] args) {
        String str = "Centro";
        String str2 = str.concat("Universitario") + "De Adamantina";

        System.out.println(str2.substring(6,9).toUpperCase());
    }
    
}
