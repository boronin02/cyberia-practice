import styles from "./Hero.module.scss";
import Image from "next/image";
import { Logos } from "../index";
import Link from "next/link";
import { max, tg, vk, people, bgPatch } from "@/shared/assets/images/hero";

export const Hero = () => {
  return (
    <>
      <section className={styles.hero}>
        <div className={styles.content}>
          <div className={styles.left}>
            <div className={styles.title}>
              <h2>Разрабатываем сложные ITпродукты: е-ком, веб-сервисы, ИИ</h2>
            </div>
            <div className={styles.subtitle}>
              <div className={styles.subtitleLeft}>
                <button className={styles.button}>Обсудить проект</button>
                <div className={styles.social}>
                  <Link href="/" className={styles.imgBox}>
                    <Image src={tg} alt="tg" width={12} height={10} />
                  </Link>
                  <Link href="/" className={styles.imgBox}>
                    <Image src={max} alt="max" width={12} height={10} />
                  </Link>
                  <Link href="/" className={styles.imgBox}>
                    <Image src={vk} alt="vk" width={12} height={10} />
                  </Link>
                </div>
              </div>
              <div className={styles.subtitleRigth}>
                <div className={styles.raiting}>
                  <div className={styles.raitingNumber}>
                    <span className={styles.number}>23</span>
                    <span className={styles.place}>место</span>
                  </div>
                  <div className={styles.text}>Разработка решений на базе ИИ</div>
                </div>
              </div>
            </div>
          </div>
          <div className={styles.rigth}>
            <Image src={people} alt="people" width={561} height={377} />
          </div>
        </div>
        <Image
          src={bgPatch}
          alt="bgPatch"
          width={864}
          height={819}
          className={styles.bgImg}
          priority
        />
      </section>
      <Logos />
    </>
  );
};
