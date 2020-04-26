import java.util.Scanner;
import java.lang.Math;
public class rectangle {
    public static void main(String[] args) {
    
   
        float longueur;
        float largeur;
       
    

    Scanner saisir= new Scanner(System.in);
    System.out.println("Veuillez saisir la longueur");
    longueur=saisir.nextFloat();
    System.out.println("Veuillez saisir la largeur");
    largeur=saisir.nextFloat();

    float demi_perimetre=longueur+largeur;
    float perimetre=(longueur+largeur)*2;
    float surface=longueur*largeur;
    double diagonale=Math.sqrt((longueur*longueur) +(largeur*largeur));
    
        if ((longueur>largeur) && (longueur>0 && largeur>0)) {
            System.out.println("Le demi-perimetre est: "+ demi_perimetre);
            System.out.println("Le perimetre est: " + perimetre);
            System.out.println("La Surface est: " + surface);
            System.out.println("La diagonale est: " + diagonale);
        }else{
            System.out.println("SYNTAX ERROR");
        }
}
}