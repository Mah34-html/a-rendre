import java.util.Scanner;

public class calculatrice {
    public static void main(String[] args) {
        int nbre1;
        int nbre2;
        int resultat=0;
        char op;

        Scanner saisir= new Scanner(System.in);
        System.out.println("Veuillez saisir la premiere valeur");
        nbre1=saisir.nextInt();
        System.out.println("Veuillez saisir la deuxieme valeur");
        nbre2=saisir.nextInt();
        System.out.println("Veuillez saisir un opérateur");
        op=saisir.next().charAt(0);

        switch (op) {
            case '+':
                resultat=nbre1+nbre2;
                break;
            case '-':
                resultat=nbre1-nbre2;
                break;
            case '*':
                resultat=nbre1*nbre2;
                break;
            case '/':
            if (nbre2!=0) {
                resultat=nbre1/nbre2;   
            }else{
                System.out.println("Veuillez saisir un deuxieme nombre correct");
            }

                break;
            default:
            System.out.println("Veuillez saisir un opérateur correct");
                break;
        }
        System.out.println("le résultat est :"+ resultat);
    }
}