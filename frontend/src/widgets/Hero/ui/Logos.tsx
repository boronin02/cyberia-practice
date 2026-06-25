import Image from "next/image";
import styles from "./Hero.module.css";
import { logos } from "@/entities/hero/model/hero.data";

export const Logos = () => {
  console.log("render");
  return (
    <div className={styles.logos}>
      {logos.map((logo) => (
        <Image
          key={logo.alt}
          src={logo.src}
          alt={logo.alt}
          width={logo.width}
          height={logo.height}
        />
      ))}
    </div>
  );
};
